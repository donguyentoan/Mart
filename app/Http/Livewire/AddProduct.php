<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Variant;
use Livewire\Component;
use App\Models\Attribute;
use Livewire\WithFileUploads;
use App\Models\ProductAttribute;
use App\Models\VariantAttribute;
use Illuminate\Support\Facades\Storage;

class AddProduct extends Component
{
    use WithFileUploads;
    public $name;
    public $priceVariant = [];
    public $stockVariant = [];
    public $isPreviewVariant = false;
    public $Productimage;
    public $imageUrl = ''; 

    public $isEditing = false;
    public $editingVariantName = null;
    public $editingVariants = [];

    public $price;
    public $stock;
    public $description;
    public $images = [];
    public $variantName = null;
    public $combinations = [];
    public $showAddVariant = false;
    public $dataVariantProducts = [];

    public $addInputVariants = false;
    public $numberOptionVariant = 1;
    public $addImageVariant = false;
    public function addVariant(){
       
        $this->showAddVariant = !$this->showAddVariant;
    }
  
    public $variants = [];          // Danh sách các biến thể

    public function mount()
    {
        $this->variants = [['nameOption' => '', 'image' => null , ]]; // Khởi tạo biến thể đầu tiên
    }

    public function addInputVariants()
    {
        $this->addInputVariants = true;
        $this->numberOptionVariant += 1;
         // Thêm biến thể mới
    }
    public function addImageVariant(){
        $this->addImageVariant = !$this->addImageVariant;
    }

    public function addOptionVariant(){
       
        $this->variants[] = ['nameOption' => '', 'image' => null  ];
    }


  
    public function saveCurrentVariant()
    {
        if ($this->isEditing) {
            $this->updateVariant();
            return;
        }
        // Initialize dataVariantProducts if it's the first time
        if (!isset($this->dataVariantProducts[$this->variantName])) {
            $this->dataVariantProducts[$this->variantName] = [];
        }

        // Process and add current variants
        foreach ($this->variants as $key => $item) {
            if (!is_null($item['image'])) {
                $this->variants[$key]['image'] = $item['image'];  // Already storing just the path
            }
        }

        // Add current variants to dataVariantProducts
        $this->dataVariantProducts[$this->variantName] = $this->variants;

        // Reset for next variant group
        $this->variants = [['nameOption' => '', 'image' => null]];
        $this->variantName = null;
       
       
       
        $this->generateVariantCombinations();
       
        // For debugging
        $this->isPreviewVariant = true;
    }


  

    // Method to handle the image upload
    public function updatedProductimage()
    {
        // Handle image upload and store the URL for the background
        if ($this->Productimage) {
            // Store the image and get the URL
            $this->imageUrl = $this->Productimage->store('products', 'public');
        }
    }

  public function saveProduct()
{
    // Tạo sản phẩm chính
    $product = Product::create([
        "name" => $this->name,
        "description" => $this->description,
        "image" => $this->imageUrl,
        "stock" => $this->stock,
        "price" => $this->price,
    ]);

    // Tạo attributes trước
    $attributesMap = [];
    foreach ($this->dataVariantProducts as $attributeName => $attributeValues) {
        $attribute = Attribute::create([
            "name" => $attributeName,
        ]);

        ProductAttribute::create([
            "attribute_id" => $attribute->id,
            "product_id" => $product->id,
        ]);

        $attributesMap[$attributeName] = $attribute->id;
    }

    // Tạo variants và variant attributes
    foreach ($this->combinations as $index => $combination) {
        // Tạo variant
        $variant = Variant::create([
            "product_id" => $product->id,
            "price" => $this->priceVariant[$index] ?? $this->price,
            "sku" => "COMB-" . $product->id . "-" . uniqid(),
            "stock" => $this->stockVariant[$index] ?? 0,
            "image" => implode(',', array_filter($combination['images'])),
        ]);

        // Tách tên combination để lấy các giá trị thuộc tính
        $values = explode('-', $combination['name']);
        $i = 0;
        
        // Tạo variant attributes cho từng thuộc tính
        foreach ($this->dataVariantProducts as $attributeName => $attributeValues) {
            VariantAttribute::create([
                "value" => $values[$i],
                "attribute_id" => $attributesMap[$attributeName],
                "variant_id" => $variant->id,
            ]);
            $i++;
        }
    }
}
    public function editVariantProduct($nameEditVariant)
    {
        // Set editing mode
        $this->isEditing = true;
        $this->editingVariantName = $nameEditVariant;
        
        // Load the variants being edited
        $this->editingVariants = $this->dataVariantProducts[$nameEditVariant];
        
        // Set the current variant name
        $this->variantName = $nameEditVariant;
        
        // Load the variants into the editing form
        $this->variants = $this->editingVariants;
        
        // Show the variant form
        $this->showAddVariant = true;
    }

    public function updateVariant()
    {
        // Update the variants in dataVariantProducts
        $this->dataVariantProducts[$this->editingVariantName] = $this->variants;
        
        // Reset editing state
        $this->isEditing = false;
        $this->editingVariantName = null;
        $this->editingVariants = [];
        
        // Reset form
        $this->variants = [['nameOption' => '', 'image' => null]];
        $this->variantName = null;
        $this->showAddVariant = false;
        
        // Regenerate combinations with updated variants
        $this->generateVariantCombinations();
        
        // Show preview
        $this->isPreviewVariant = true;
    }

    public function removeVariantOption($optionName)
    {
        // Duyệt qua mảng dataVariantProducts
        foreach ($this->dataVariantProducts as $variantName => $variants) {
            // Lọc ra các variants không có nameOption trùng với optionName cần xóa
            $this->dataVariantProducts[$variantName] = array_filter($variants, function($variant) use ($optionName) {
                return $variant['nameOption'] !== $optionName;
            });
            
            // Nếu không còn variant nào trong nhóm, xóa luôn nhóm đó
            if (empty($this->dataVariantProducts[$variantName])) {
                unset($this->dataVariantProducts[$variantName]);
            } else {
                // Reset array keys để tránh lỗi với các key không liên tục
                $this->dataVariantProducts[$variantName] = array_values($this->dataVariantProducts[$variantName]);
            }
        }

        // Cập nhật lại combinations nếu cần
        $this->generateVariantCombinations();
        
    }

    public function generateVariantCombinations()
    {
        $combinations = [];
        
        // Kiểm tra có ít nhất 2 nhóm biến thể
        if (count($this->dataVariantProducts) < 1) {
            return [];
        }

        // Lấy ra các mảng giá trị của từng nhóm biến thể
        $variantGroups = array_values($this->dataVariantProducts);
        
        // Bắt đầu với nhóm đầu tiên
        $result = array_map(function($item) {
            return [$item];
        }, $variantGroups[0]);

        // Tạo tổ hợp cho các nhóm còn lại
        for ($i = 1; $i < count($variantGroups); $i++) {
            $temp = [];
            foreach ($result as $existingCombination) {
                foreach ($variantGroups[$i] as $newVariant) {
                    $temp[] = array_merge($existingCombination, [$newVariant]);
                }
            }
            $result = $temp;
        }

        // Format kết quả
        foreach ($result as $combination) {
            $combinations[] = [
                'name' => implode('-', array_map(function($item) {
                    return $item['nameOption'];
                }, $combination)),
                'images' => array_map(function($item) {
                    return $item['image'];
                }, $combination),
                
            ];
        }

        $this->combinations = $combinations;
      
    }
       
   

    public function updatedVariants($value, $index)
    {
        if (!str_contains($index, 'image')) {
            return;
        }
        
        $variantIndex = explode('.', $index)[0];
        
        $this->validate([
            "variants.$variantIndex.image" => 'image|max:1024',
        ]);
    
        $file = $this->variants[$variantIndex]['image'];
        $path = $file->store('images', 'public');
        
       
        $asset_url = asset('storage/' . $path);
        
        $this->variants[$variantIndex]['image'] = $asset_url;
    }
    
    
    

    public function render()
    {
        return view('livewire.add-product');
    }
}
