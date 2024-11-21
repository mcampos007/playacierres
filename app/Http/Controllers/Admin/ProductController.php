<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProductRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;

class ProductController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        //
        $products = Product::paginate( 10 );
        return view( 'admin.products.index' )->with( compact( 'products' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        //
        //$product = new Product();
        return view( 'admin.products.create' );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        //

        //Validación
        $rules = [
            'name' => 'required|min:5|max:45',
            'price' => 'required'
        ];
        $messages = [
            'name.required' => 'Debe Ingresar un nombre para el producto',
            'name.min' => 'El nombre del producto debe tener al menos cinco caracteres.',
            'name.max' => 'El nombre del producto NO debe tener mas de 45 caracteres.',
            'price.required' => 'El producto debe tener un precio.'

        ];
        $this->validate( $request, $rules, $messages );

        $name = $request->input( 'name' );
        $price = $request->input( 'price' );

        $product = new Product();
        $product->name = $name;
        $product->price = $price;

        $product->save();

        if ( !$product ) {
            $notification = 'Hubo problemas al registrar el nuevo producto';
        } else {
            $notification = 'El nuevo producto se ha registrado correctamente!!';
        }

        return redirect()->route( 'admin.products' )->with( compact( 'notification' ) );

        //   dd( $product );

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        //
        $product = Product::findOrFail( $id );

        return view( 'admin.products.edit' )->with( compact( 'product' ) );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $id ) {
        //

        $product = Product::findOrFail( $id );

        $product->name = $request->input( 'name' );
        $product->price = $request->input( 'price' );

        $product->save();

        $notification = 'Se actualizaron los datos del producto';

        return redirect( 'admin/products' )->with( compact( 'notification' ) );
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function delete( $id ) {
        //
        $product = Product::find( $id );
        if ( !$product ) {
            $notification = 'No existe el producto a eliminar!!';
        } else {
            $result = $product->delete();
            if ( !$result ) {
                $notification = 'Hubo un  error al eliminar el producto';
            } else {
                $notification = 'el producto se eliminó correctamente!!';
            }

        }

        return redirect( 'admin/products' )->with( compact( 'notification' ) );

    }
}
