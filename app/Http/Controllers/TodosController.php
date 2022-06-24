<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TodosController extends Controller
{
    //INDEX PARA MOSTRAR TODOS LOS TODOS
    //STORE PARA GUARDAR TODOS
    //UPDATE PARA ACTUALIZAR TODOS
    //DESTROY PARA ELIMINAR UN TODO
    //EDIT PARA MOSTRAR EL FORMULARIO DE EDICION

    public function store(Request $request)
    {
        //VALIDACION DE UN CAMPO POR MEDIO DEL METODO VALIDATE DE LARAVEL, EVITAMOS USAR IFS
        $request->validate([
            'title' => 'required|min:3'
        ]);

        // CREAMOS UN NUEVO ELEMENTO
        $todo = new Todo();
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        // GUARDAMOS NUESTRO ELEMENTO CON EL METODO SAVE, ESTE METODO LO IMPLEMENTAN TODO LOS MODELOS     
        $todo->save();

        // REDIRIGIMOS AL USAURIOS A UN RUTA
        return redirect()->route('todos')->with("success", "Tarea creada correctamente");
    }

    public function index()
    {
        // EN ESTE CASO HACEMOS UNA CONSULTA, EL METODO ALL LO IMPLEMENTAN TODOS LOS MODELOS DE FORMA ESTATICA
        $todos = Todo::all();
        $categories = Category::all();

        return view('todos.index', ['todos' => $todos, 'categories' => $categories]);
    }

    // ID ES EL PARAMETRO EL CUAL ENVIAMOS DESDE LA RUTA
    public function show($id)
    {
        // METODO FIND REALIZA LA BUSQUEDA EN LE BASE DE DATOS POR ID O POR EL PARAMETRO QUE ESPECIFIQUEMOS
        $todo = Todo::find($id);
        // UNA VEZ ENCONTRADO EL DATO, MANDAREMOS A LA VISTA UN MODELO EL CUAL CONTENDRA LOS VALORES DE NUESTRA FILA
        return view('todos.show', ['todo' => $todo]);
    }

    // AL SER UN METODO POST MANDAMOS NUESTRO VALOR EN REQUEST, Y ADEMAS ESTAMOS OBTENIENDO EL ID DEL DATO A MODIFICAR
    public function update(Request $request, $id)
    {
        // BUSCAMOS EL DATO A MODIFICAR
        $todo = Todo::find($id);

        // EL DATO ENCONTRADO LE ASIGNAMOS EL NUEVO DATO QUE VIENE DE REQUEST
        $todo->title = $request->title;

        // AHORA GUARDANOS EL VALOR, SAVE HARA QUE LO MANDE A LA BASE DE DATOS
        $todo->save();

        // AHORA REDIRECCIONAMOS A LA RUTA TODOS EL CUAL ES LA ACTION INDEX
        return Redirect()->route('todos')->with("success", "Tarea actualizada");
    }

    public function destroy($id)
    {
        $todo = Todo::find($id);

        $todo->delete();

        return Redirect()->route('todos')->with("success", "Tarea ha sido eliminada");
    }
}
