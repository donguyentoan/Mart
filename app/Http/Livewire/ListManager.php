<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ListManager extends Component
{
    public $data = [];

    public function render()
    {
        return view('livewire.list-manager');
    }


    public function getListManager($product){
        if($product == "products"){
            $this->data = [
                [
                    "name" => "toan",
                    "price" => 10000,
                    "description" => "chao cac ban"
                ],
                [
                    "name" => "toan1",
                    "price" => 10000,
                    "description" => "chao cac ban1"
                ],
                [
                    "name" => "toan3",
                    "price" => 10000,
                    "description" => "chao cac ban3"
                ]
            ];
        }
        else if($product == "order"){
            $this->data = [
                [
                    "username" => "Do Nguyên Toan",
                    "name" => "toan",
                    "price" => 10000,
                    "description" => "chao cac ban"
                ],
                [
                    "username" => "Do Nguyên Tai",
                    "name" => "toan1",
                    "price" => 10000,
                    "description" => "chao cac ban1"
                ],
                [
                    "username" => "Do Khac Phong",
                    "name" => "toan3",
                    "price" => 10000,
                    "description" => "chao cac ban3"
                ]
            ];

        } else if($product == "categories"){
            
        } else if($product == "payment"){
            
        } else if($product == "banner"){
            
        }else if($product == "slider"){
            
        }
       
    }

   
}
