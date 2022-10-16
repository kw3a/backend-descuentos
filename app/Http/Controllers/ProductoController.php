<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Promocion;
use App\Models\Negocio;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 

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
        ->leftJoin('promocion', 'promocion.id_producto', '=', 'producto.id_producto')
        // ->where('fechaFin', '>', $hoy)
        // ->whereIn('fechaFin', '>', $hoy)
        ->select(
          'producto.id_producto',
          'id_categoria',
          'nombre',
          'precio',
          'fecha_fin'
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
    public function store(Request $request)
    {
      $messages = [
        'required' => 'El campo :attribute es obligatorio',
        'unique' => 'El nombre :input ya fue tomado',
        // 'equipos.*.preinscripcion_numero_de_deposito.unique' => 'El numero de transaccion :input ya uso en otro equipo',
        // 'equipos.*.categoria.required' => 'Debe seleccionar una categoria',
        // 'equipo_nacionalidad.required' => 'Debe seleccionar una nacionalidad'
      ];
    
      $request->validate([
        'producto_nombre' => 'required|min:3|max:50',
        'producto_precio' => 'required|min:1|max:8',
        //'producto_ubicacion' => 'required|min:5|max:50',
        'producto_descripcion' => 'required|min:5|max:255',
        'producto_categoria' => 'required',
        'promocion_descuento' => 'required',
        'promocion_fecha_inicio' => 'required',
        'promocion_fecha_fin' => 'required',
        'promocion_hora_inicio' => 'required',
        'promocion_hora_fin' => 'required',
        'negocio_id' => 'required'
      ], $messages);

      $product = Producto::create([
        'id_negocio' => $request->negocio_id,
        'id_categoria' => $request->producto_categoria,
        'nombre' => $request->producto_nombre,
        'descrip' => $request->producto_descripcion,
        'precio' => $request->producto_precio
        //'url_imagen' => $request->producto_url_imagen
      ]);
      // // echo "hola".$producto->id_producto;

      Promocion::create([
        'id_producto' => $product->id_producto,
        'descuento' => $request->promocion_descuento,
        //'descuento_nombre' => $request->descuento_nombre,
        'fecha_ini' => $request->promocion_fecha_inicio,
        'fecha_fin' => $request->promocion_fecha_fin,
        'hora_ini' => $request->promocion_hora_inicio,
        'hora_fin' => $request->promocion_hora_fin,
        'ubicacion' => $request->promocion_ubicacion
      ]);

      
      
      // $token = $usuario->createToken("compromiso")->plainTextToken;
      
      // $response = [
      //   'usuario_id' => $usuario->usuario_id,
      //   'token' => $token
      // ];
      // return response($response);
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