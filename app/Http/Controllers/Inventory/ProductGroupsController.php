<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;

use App\Models\Product\Product;
use App\Models\Product\ProductGroup;

use App\Http\Controllers\Controller;

class ProductGroupsController extends Controller
{
    private function getTreeJS($root_id, &$treejs)
    {
        
        $groups = ProductGroup::where('parent_id', $root_id)->get();
        
        $treejs .= '[';
        foreach($groups as $group)
        {
            $treejs .= '{';
                $treejs .= '"dbid":"' . $group->id . '",';
                $treejs .= '"text":"' . $group->name . '[' . $group->id . ']",';
                $treejs .= '"children":';
                
            $treejs .= $this->getTreeJS($group->id, $treejs);
            $treejs .= '},';
        }
        $treejs .= ']';
    }

    public function show_tree()
    {
        // Create Tree JS
        $root_id = 10001;
        $treejs = '';
        $this->getTreeJS($root_id, $treejs);
        $treeJS = $treejs;
        return view('inventory.product_groups.showtree', compact('treeJS'));
    }

    // Move Node on ProductGroup Tree
    public function treeviewDnd()
    {
        $group = ProductGroup::find(request()->source);
        if ($group)
        {
            if (request()->destination)
            {
                if (request()->destination == '#')
                {
                    $group->parent_id = null;
                }
                else
                {
                    $group->parent_id = request()->destination;
                }
            } 
            $group->update();
        }
    }

    // Rename Node on ProductGroup Tree
    public function treeviewRename()
    {
        $group = ProductGroup::find(request()->dbid);
    
        if ($group)
        {
            $name = request()->name;
            if ($name)
            {            
                $group->name = $name;
                $group->update();
            }    
        }
    }

    // Delete Node on ProductGroup Tree
    public function treeviewDelete()
    {        
        $group = ProductGroup::find(request()->id);
        
        if ($group)
        {
            $group->delete();
        }

    }

    // Create Node on ProductGroup Tree
    public function treeviewCreate()
    {
        $group = [
            "name" => request()->name,
            "parent_id" => request()->parentid,
        ];
        $result = ProductGroup::create($group);
        
        return $result;
    }

    public function show(Request $request, ProductGroup $group)
    {
        return view('inventory.product_groups.show', [
            'group' => $group,
            'products' => Product::where('product_group_id', $group->id)->paginate(25)
        ]);
    }
}
