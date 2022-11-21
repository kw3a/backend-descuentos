<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Promocion;
use App\Models\Negocio;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $hoy = Carbon::today();
      $productos = DB::table('producto')
        ->leftJoin('promocion', 'promocion.producto_id', '=', 'producto.id')
        ->select(
          'producto.id',
          'categoria',
          'nombre',
          'precio',
          'descuento',
          'fecha_fin',
          'imagen'
        )
        ->get();
      return $productos;
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoRequest $request)
    {
      $image_url = $request->photo->store('images');

      $product = Producto::create([
        'negocio_id' => $request->negocio_id,
        'categoria' => $request->producto_categoria,
        'nombre' => $request->producto_nombre,
        'descrip' => $request->producto_descripcion,
        'precio' => $request->producto_precio,
        'activo' => 1,
        'imagen' => substr($image_url, 7)
      ]);

      Promocion::create([
        'descuento' => $request->promocion_descuento,
        'fecha_ini' => $request->promocion_fecha_inicio,
        'fecha_fin' => $request->promocion_fecha_fin,
        'hora_ini' => $request->promocion_hora_inicio,
        'hora_fin' => $request->promocion_hora_fin,
        'producto_id' => $product->id
      ]);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
