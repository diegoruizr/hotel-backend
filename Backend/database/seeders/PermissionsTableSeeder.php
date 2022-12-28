<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission= new Permission();
        $permission->name="Ver pagina de inicio";
        $permission->parent=null;
        $permission->action="";
        $permission->description="Permite ver la pagina de inicio";
        $permission->view="home";
        $permission->route="home";
        $permission->is_group=0;
        $permission->code="0";
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();


        /**
         * PERMISOS PARA VISTA HOTEL
         */
        $permission= new Permission();
        $permission->name="Gestion de Hoteles";
        $permission->parent=null;
        $permission->action="";
        $permission->description="Grupo de permisos de Hoteles";
        $permission->view="";
        $permission->route="";
        $permission->is_group=1;
        $permission->code=100;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();
        $idAnterior = $permission->id;

        $permission= new Permission();
        $permission->name="Listar Hoteles";
        $permission->parent=$idAnterior;
        $permission->action="all";
        $permission->description="Permite ver los Hoteles";
        $permission->view="hotels";
        $permission->route="hotels";
        $permission->is_group=0;
        $permission->code=101;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();

        $permission= new Permission();
        $permission->name="Cambiar estado Hotel";
        $permission->parent=$idAnterior;
        $permission->action="state";
        $permission->description="Permite cambiar el estado del Hotel";
        $permission->view="state_hotel";
        $permission->route="";
        $permission->is_group=0;
        $permission->code=102;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();

        $permission= new Permission();
        $permission->name="Crear Hotel";
        $permission->parent=$idAnterior;
        $permission->action="create";
        $permission->description="Permite crear una Hotel";
        $permission->view="create_hotel";
        $permission->route="hotel";
        $permission->is_group=0;
        $permission->code=103;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();

        $permission= new Permission();
        $permission->name="Modificar Hotel";
        $permission->parent=$idAnterior;
        $permission->action="edit";
        $permission->description="Permite modificar una Hotel";
        $permission->view="edit_hotel";
        $permission->route="hotel";
        $permission->is_group=0;
        $permission->code=104;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();

        $permission= new Permission();
        $permission->name="Ver Hotel";
        $permission->parent=$idAnterior;
        $permission->action="view";
        $permission->description="Permite ver los detalles de una Hotel";
        $permission->view="view_hotel";
        $permission->route="hotel";
        $permission->is_group=0;
        $permission->code=105;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();

        /**
         * PERMISOS PARA VISTA ASIGNAR TIPOS DE HABITACIONES
         */
        $permission= new Permission();
        $permission->name="Gestion de Asignacion de tipos de habitaciones";
        $permission->parent=null;
        $permission->action="";
        $permission->description="Grupo de permisos de Asignacion de tipos de habitaciones";
        $permission->view="";
        $permission->route="";
        $permission->is_group=1;
        $permission->code=200;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();
        $idAnterior = $permission->id;

        $permission= new Permission();
        $permission->name="Listar Asignacion de tipos de habitaciones";
        $permission->parent=$idAnterior;
        $permission->action="all";
        $permission->description="Permite ver Asignacion de tipos de habitaciones";
        $permission->view="assing_room_types";
        $permission->route="assing_room_types";
        $permission->is_group=0;
        $permission->code=201;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();

        $permission= new Permission();
        $permission->name="Crear Asignacion de tipos de habitaciones";
        $permission->parent=$idAnterior;
        $permission->action="create";
        $permission->description="Permite crear Asignacion de tipos de habitaciones";
        $permission->view="create_assing_room_type";
        $permission->route="assing_room_type";
        $permission->is_group=0;
        $permission->code=203;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();

        $permission= new Permission();
        $permission->name="Modificar de Asignacion de tipos de habitaciones";
        $permission->parent=$idAnterior;
        $permission->action="edit";
        $permission->description="Permite modificar la Asignacion de tipos de habitaciones";
        $permission->view="edit_assing_room_type";
        $permission->route="assing_room_type";
        $permission->is_group=0;
        $permission->code=204;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();

        $permission= new Permission();
        $permission->name="Ver Asignacion de tipos de habitaciones";
        $permission->parent=$idAnterior;
        $permission->action="view";
        $permission->description="Permite ver los detalles de la Asignacion de tipos de habitaciones";
        $permission->view="view_assing_room_type";
        $permission->route="assing_room_type";
        $permission->is_group=0;
        $permission->code=205;
        $permission->state=1;
        $permission->created_by=1;
        $permission->updated_by=null;
        $permission->save();
    }
}
