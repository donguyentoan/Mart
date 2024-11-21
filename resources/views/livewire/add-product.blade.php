<div>
    <div class='bg-gray-100'>
        <div class="">
            <div class='flex'>
                <div class='w-full mx-auto p-6'>
                    <div class='flex items-center justify-between'>
                        <div class=' flex '>
                            <p class='pr-4'> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                                <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1" />
                            </svg> </p>
                            <p class='text-md font-black'>New Product</p>
                        </div>
                        <div class='flex'>
                            <h1 class='pr-2'>Duplicate</h1>
                            <h1 class='pl-2 '>Preview</h1>
                        </div>
                    </div>

                    <div class='flex mt-4'>

                        <div class='w-2/3'>
                            <div>
                                <form class='w-full' action="" onSubmit={createVariantProduct}>
                                    <div class=' bg-white p-4 rounded-xl shadow-inner'>
                                        <div class='pt-4'>
                                            <h1 class='font-bold text-sm '>Title</h1>
                                            <input class='border-[1px] w-full p-1  rounded-md' type="text" wire:model="name" name="name" id="" />
                                        </div>
                                        <div class='pt-4'>
                                            <h1 class='font-bold text-sm  '>Price</h1>
                                            <input class='border-[1px] w-full p-1  rounded-md' type="text" wire:model="price" name="price" id="" />
                                        </div>
                                        <div class='pt-4'>
                                            <h1 class='font-bold text-sm '>Stock</h1>
                                            <input class='border-[1px] w-full p-1  rounded-md' type="text" wire:model="stock" name="stock" id="" />
                                        </div>
                                        <div class='pt-4'>
                                            <h1 class='font-bold text-sm '>Description</h1>
                                          {{-- <div class='editor'>
                                                <TextEditor />
                                            </div> --}}
                                            <textarea rows="5" class='w-full rounded-md font-bold text-xl mb-2 border-[1px]' wire:model="description" name="description" id="">

                                            </textarea>


                                        </div>

                                    </div>
                                    
                                </form>
                            </div>
                           
                            <div class=' bg-white p-4 rounded-xl shadow-inner mt-4'>
                                <div class='pt-4 flex justify-between '>
                                    <h1 class='text-sm font-medium'>Media</h1>
                                    <button class="text-sm">Add Media from URL</button>
                                </div>
                                <div class='flex justify-between pt-4'>
                                    <div class='border-2 w-full h-[335px] border-dashed mr-2 flex justify-center items-center'
                                         style="background-image: url('{{ asset('storage/' . $imageUrl) }}'); background-size: cover; background-position: center;">
                                        <input
                                            id="fileInputImage"
                                            type="file"
                                            class="hidden"
                                            wire:model="Productimage"
                                            accept="image/*"
                                        />
                                        @if($imageUrl == null)
                                        <svg
                                            onclick="document.getElementById('fileInputImage').click()"
                                            xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bookmark-plus-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5m6.5-11a.5.5 0 0 0-1 0V6H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V7H10a.5.5 0 0 0 0-1H8.5z" />
                                        </svg>
                                        @endif
                                    </div>
                                </div>
                                
                                
         


                            </div>
                            <div class=' bg-white p-4 rounded-xl shadow-inner mt-4'>
                                <div class='pt-4 flex items-center '>
                                    <input wire:change="addVariant" class='w-5 h-5' type="checkbox" name="" id="" />
                                    <h1 class='font-medium text-sm pl-4'>Add  Variant Product</h1>

                                </div>
                               @if($showAddVariant)
                                    <div class='add_variant_product'>
                                     
                                        <div>
                                            <div class='pt-4'>
                                                <div class='flex justify-between '>
                                                    <h3 class='font-medium text-sm'>Variant Name</h3>
                                                    <h3 class="text-sm font-medium" wire:click="addImageVariant" > Add image</h3>
                                                </div>
                                             
                                                <input
                                                    wire:model="variantName"
                                                    wire:input="addInputVariants"
                                                    class='border-[1px] w-full p-1 rounded-md  placeholder:text-xs'
                                                    type="text"
                                                    placeholder="Variant Name"
                                                   
                                                />
                                            </div>
                                        </div>
                                       
                                        @if($addInputVariants )
                                        <div>
                                            @foreach ($variants as $index => $variant)
                                                <div class="variant_add_product border p-4  mb-4 mt-3 rounded-lg">
                                                    <div class='flex justify-between items-center '>
                                                        @if($variant['image'])
                                                            <div>
                                                                <input
                                                                    id="fileInput{{ $index }}"
                                                                    type="file"
                                                                    wire:model="variants.{{ $index }}.image"
                                                                    class='mr-2 hidden'
                                                                    accept="image/*"
                                                                />
                                                                <img
                                                                    src="{{ $variant['image'] ?? '../assets/img/default.png' }}"
                                                                    alt="Preview"
                                                                    class='pointer w-16 h-16'
                                                                    onclick="document.getElementById('fileInput{{ $index }}').click()"
                                                                />
                                                            </div>
                                                        @else
                                                        @if($addImageVariant)
                                                        <div>
                                                            <input
                                                                id="fileInput{{ $index }}"
                                                                type="file"
                                                                class="hidden"
                                                                wire:model="variants.{{ $index }}.image"
                                                                accept="image/*"
                                                            />
                                                        
                                                           
                                                            <img
                                                            src="{{ isset($variant['image']) ?  asset('storage/' . $variant['image']) : asset('assets/img/default.png') }}"
                                                            alt="Preview"
                                                            class="pointer w-16 h-16"
                                                            onclick="document.getElementById('fileInput{{ $index }}').click()"
                                                        />
                                                        </div>
                                                        
                                                        
                                                        
                                                    @endif

                                                        @endif
                                        
                                                        <input
                                                            wire:model="variants.{{ $index }}.nameOption"
                                                            class='placeholder:text-xs border-[1px] {{ $variant["image"] ? "w-10/12" : "w-full" }} p-1 rounded-md mr-2'
                                                            type="text"
                                                            placeholder="Option Name"
                                                        />
                                        
                                                        <button wire:click="addOptionVariant">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                                                                <path d="M8 0q-.264 0-.523.017l.064.998a7 7 0 0 1 .918 0l.064-.998A8 8 0 0 0 8 0M6.44.152q-.52.104-1.012.27l.321.948q.43-.147.884-.237L6.44.153zm4.132.271a8 8 0 0 0-1.011-.27l-.194.98q.453.09.884.237zm1.873.925a8 8 0 0 0-.906-.524l-.443.896q.413.205.793.459zM4.46.824q-.471.233-.905.524l.556.83a7 7 0 0 1 .793-.458zM2.725 1.985q-.394.346-.74.74l.752.66q.303-.345.648-.648zm11.29.74a8 8 0 0 0-.74-.74l-.66.752q.346.303.648.648zm1.161 1.735a8 8 0 0 0-.524-.905l-.83.556q.254.38.458.793l.896-.443zM1.348 3.555q-.292.433-.524.906l.896.443q.205-.413.459-.793zM.423 5.428a8 8 0 0 0-.27 1.011l.98.194q.09-.453.237-.884zM15.848 6.44a8 8 0 0 0-.27-1.012l-.948.321q.147.43.237.884zM.017 7.477a8 8 0 0 0 0 1.046l.998-.064a7 7 0 0 1 0-.918zM16 8a8 8 0 0 0-.017-.523l-.998.064a7 7 0 0 1 0 .918l.998.064A8 8 0 0 0 16 8M.152 9.56q.104.52.27 1.012l.948-.321a7 7 0 0 1-.237-.884l-.98.194zm15.425 1.012q.168-.493.27-1.011l-.98-.194q-.09.453-.237.884zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a7 7 0 0 1-.458-.793zm13.828.905q.292-.434.524-.906l-.896-.443q-.205.413-.459.793zm-12.667.83q.346.394.74.74l.66-.752a7 7 0 0 1-.648-.648zm11.29.74q.394-.346.74-.74l-.752-.66q-.302.346-.648.648zm-1.735 1.161q.471-.233.905-.524l-.556-.83a7 7 0 0 1-.793.458zm-7.985-.524q.434.292.906.524l.443-.896a7 7 0 0 1-.793-.459zm1.873.925q.493.168 1.011.27l.194-.98a7 7 0 0 1-.884-.237zm4.132.271a8 8 0 0 0 1.012-.27l-.321-.948a7 7 0 0 1-.884.237l.194.98zm-2.083.135a8 8 0 0 0 1.046 0l-.064-.998a7 7 0 0 1-.918 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                        
                                                   
                                                </div>
                                            @endforeach
                                            <button wire:click="saveCurrentVariant" class='mt-2 bg-blue-500 text-sm text-white p-1 rounded'>
                                                Save Variant
                                            </button>
                                        </div>
                                        
                                        @endif
                                     


                                   
                                        <div class='mt-4'>
                                         
                                            @if($dataVariantProducts)
                                            <h2 class='font-medium'>Variants List</h2>
                                            @foreach ($dataVariantProducts as $variantName => $variants)
                                                <div class='border p-2 mt-2 rounded-md bg-[#ededed69]'>
                                                    <h3 class='font-bold text-md uppercase'>{{$variantName}}</h3>
                                                    <div class='flex justify-between items-center'>
                                                        <ul class='pt-4 grid grid-cols-7 gap-4'>
                                                            @foreach ($variants as $variant) 
                                                            <div class="flex bg-slate-300 items-center rounded-lg">
                                                                <div>
                                                                    <li class='w-fit  px-2 py-1 h-fit  text-black'>
                                                                        {{$variant['nameOption']}}
                                                                      
                                                                    </li>
                                                                </div>
                                                               
                                                                <div wire:click="removeVariantOption('{{$variant['nameOption']}}')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-x font-bold" viewBox="0 0 16 16">
                                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                                                      </svg>
                                                                </div>
                                                            </div>
                                                               
                                                            @endforeach
                                                        </ul>
                                                        <button
                                                            wire:click="editVariantProduct('{{$variantName}}')"
                                                            class='text-black underline mt-2'
                                                        >
                                                            {{ $isEditing && $editingVariantName === $variantName ? 'Editing...' : 'Edit' }}
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    
                                        
                                        </div>
                                    </div>
                                @endif




                            </div>
                            @if($isPreviewVariant)
                            <div class=' bg-white p-4 rounded-xl shadow-inner '>
                                <div class='pt-4'>
                                    <h1 class='font-medium'>Preview</h1>

                                </div>
                                <form action="" onSubmit={saveVariant}>
                                    <div>
                                        <table class="table-auto w-full text-left whitespace-no-wrap">

                                            <thead>
                                                <tr>
                                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">Variant</th>
                                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Price</th>
                                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Quantity</th>
                                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">SKU</th>

                                                    <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                
                                                @foreach ($combinations as $index => $variant)
                                                <tr key="{{ $index }}">
                                                    <td class="text-black">
                                                        {{ $variant['name'] }}
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        <input wire:model="priceVariant.{{$index}}" class="border-[1px]" type="text" placeholder="Enter price" />
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        <input wire:model="stockVariant.{{$index}}" class="border-[1px] w-12" type="text" />
                                                    </td>
                                                    
                                                    <td class="w-10 text-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill cursor-pointer" viewBox="0 0 16 16">
                                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                                        </svg>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                
                                                    



                                          




                                            </tbody>

                                        </table>
                                       


                                    </div>
                                </form>


                            </div>
                            @endif

                        </div>

                        <div class='w-1/3 ml-4' >
                            <div class='bg-white p-4 rounded-xl shadow-inner'>
                                <div class='w-full'>
                                    <h1 class='text-md font-semibold'>Product Status</h1>
                                    <select class='w-full border-[1px] rounded-lg p-2 my-4' name="" id="">
                                        <option value="">Draw</option>
                                    </select>

                                </div>

                            </div>
                            <div>
                            <button class="p-1 bg-red-400 text-white m-2 rounded-md" wire:click="saveProduct">Save Product</button>    
                            </div>  
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
