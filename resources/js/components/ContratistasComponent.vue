<template>
    <!-- Main content -->
    <!-- Default box -->
    <main class="main">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Categorías</h3>
                <button type="button" class="btn btn-secondary" @click="AbrirModal('Contratistas', 'Registrar')">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>

                <div class="card-tools">
                    <button
                        type="button"
                        class="btn btn-tool"
                        data-card-widget="collapse"
                        title="Collapse"
                    >
                        <i class="fas fa-minus"></i>
                    </button>
                    <button
                        type="button"
                        class="btn btn-tool"
                        data-card-widget="remove"
                        title="Remove"
                    >
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="display" style="width:100%" id="tabla">
                    <thead>
                        <tr>
                            <th style="width: 4%">
                                Id
                            </th>
                            <th style="width: 19%">
                                Nombre
                            </th>
                            <th style="width: 19%">
                                Apellido
                            </th>
                            <th style="width: 18%">
                                Documento
                            </th>
                            <th style="width: 18%">
                                Estado
                            </th>
                            <th style="width: 20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="data in arrayContratistas" :key="data.id">
                            <td v-text="data.id">
                                
                            </td>
                            <td>
                                <a v-text="data.nombre"></a>
                                <br />
                                <small v-text="data.created_at">
                                </small>
                            </td>
                            <td v-text="data.apellido">

                            </td>
                            <td v-text="data.tipodocumento + '. ' + data.documento">

                            </td>
                            <td class="project-state">
                                <div v-if="data.estado == 1">
                                    <span class="badge badge-success">Activo</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">Desactivo</span>
                                </div>
                            </td>
                            <td class="project-actions text-right">
                                <!--<a class="btn btn-primary btn-sm" href="#">
                              <i class="fas fa-folder">
                              </i>
                              Ver
                          </a>
                          -->
                                <a class="btn btn-info btn-sm" href="#" @click="AbrirModal('Contratistas','Actualizar', data)">
                                    <i class="fas fa-pencil-alt"> </i>
                                    Editar
                                </a>
                                <a class="btn btn-danger btn-sm" href="#" @click="DesactivarContratista(data.id)">
                                    <i class="fas fa-trash"> </i>
                                    Desactivar
                                </a>
                                <a class="btn btn-info btn-sm" href="#" @click="ActivarContratista(data.id)">
                                    <i class="fas fa-check"> </i>
                                    Activar
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!--Inicio del modal agregar/actualizar-->
        <div
            class="modal fade"
            id="modalNuevo"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myModalLabel"
            aria-hidden="true"
            :class="{'mostrar' : modal}"
        >
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                        <button type="button" class="close" aria-label="Close" @click="CerrarModal()">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form
                            action=""
                            method="post"
                            enctype="multipart/form-data"
                            class="form-horizontal"
                        >
                            <div class="form-group row">
                                <label
                                    class="col-md-3 form-control-label"
                                    for="text-input"
                                    >Nombre</label
                                >
                                <div class="col-md-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Nombre contratista"
                                        v-model="nombre"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 form-control-label"
                                    for="text-input"
                                    >Apellido</label
                                >
                                <div class="col-md-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Apelllido contratista"
                                        v-model="apellido"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 form-control-label"
                                    >Tipo documento</label
                                >
                                <div class="col-md-9">
                                   <select class="form-control" v-model="tipodocumento">
                                        <option disabled value="">Seleccione</option>
                                        <option>CC</option>
                                        <option>CE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-md-3 form-control-label"
                                    for="text-input"
                                    >Documento</label
                                >
                                <div class="col-md-9">
                                    <input
                                        v-model="documento"
                                        type="text"
                                        class="form-control"
                                        placeholder="Documento contratista" 
                                        
                                    />
                                </div>
                            </div>
                
                
                            <div class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="CerrarModal()">
                            Cerrar
                        </button>
                        <button type="button" v-if="tipoAccion == 1" class="btn btn-primary" @click="RegistrarContratista()">
                            Guardar
                        </button>
                        <button type="button" v-if="tipoAccion == 2" class="btn btn-primary" @click="ActualizarContratista()">
                            Actualizar
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
    </main>
</template>

<script>
export default {
    data(){
        return{
            modal : 0,
            tituloModal : '',
            tipoAccion : 0,
            id : 0,
            nombre : '',
            apellido : '',
            tipodocumento : '',
            documento : '',
            arrayContratistas:[]
        }
    },
    methods:{
        ListarContratistas(){
            let me = this;

            axios.get('/contratistas').then(response => {
                me.arrayContratistas = response.data;
                this.tabla(); //Cargar el datatable
                //console.log(me.arrayCategorias);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });
        },

        tabla(){
            this.$nextTick(() => {
                $('#tabla').DataTable();
            });
        },

        AbrirModal(modelo, accion, data){
            switch(modelo){
                case 'Contratistas':{
                    switch(accion){
                        case 'Registrar':
                        {
                            this.modal = 1,
                            this.tituloModal = 'Registrar Contratista',
                            this.tipoAccion = 1,
                            this.nombre = '',
                            this.apellido = '',
                            this.tipodocumento = '',
                            this.documento = ''
                            break;
                        }
                        case 'Actualizar':{
                            this.modal = 1,
                            this.tituloModal = 'Actualizar Contratista',
                            this.tipoAccion = 2,
                            this.id = data['id'],
                            this.nombre = data['nombre'],
                            this.apellido = data['apellido'],
                            this.tipodocumento = data['tipodocumento'],
                            this.documento = data['documento']
                            break;
                        }
                    }
                    break;
                }
            }
        },

        CerrarModal(){
            this.modal = 0,
            this.tituloModal = '',
            this.tipoAccion = 0,
            this.nombre = '',
            this.apellido = '',
            this.tipodocumento = '',
            this.documento = ''
        },

        RegistrarContratista(){
            let me = this;
            axios.post('/contratistas/registrar',{
                'nombre' : this.nombre,
                'apellido' : this.apellido,
                'tipodocumento' : this.tipodocumento,
                'documento' : this.documento
            })
            .then(function (response) {
                me.CerrarModal();
                me.ListarContratistas();
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            })
            .then(function () {
                // always executed
            });
        },

        ActualizarContratista(){
            let me = this;
            axios.put('/contratistas/actualizar',{
                'id' : this.id,
                'nombre' : this.nombre,
                'apellido' : this.apellido,
                'tipodocumento' : this.tipodocumento,
                'documento' : this.documento
            })
            .then(function (response) {
                me.CerrarModal();
                me.ListarContratistas();
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            })
            .then(function () {
                // always executed
            });
        },

        ActivarContratista(Id){
            let me = this;
            axios.put('/contratistas/activar',{
                'id' : Id,
            })
            .then(function (response) {
                me.ListarContratistas();
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            })
            .then(function () {
                // always executed
            });
        },

        DesactivarContratista(Id){
            let me = this;
            axios.put('/contratistas/desactivar',{
                'id' : Id,
            })
            .then(function (response) {
                me.ListarContratistas();
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            })
            .then(function () {
                // always executed
            });
        }
    },
    mounted() {
        //console.log("Construyendo el Componente");
        this.ListarContratistas();
    }
};
</script>
<style>
    .modal-content{
        width: 100% !important;
        margin-top: 80px !important;
        position: absolute !important;
    }

    .mostrar{
        display: list-item !important;
        /*position: absolute !important;*/
        background-color: rgba(0, 0, 0, 0.2) !important;
        opacity: 1 !important;
    }
</style>
