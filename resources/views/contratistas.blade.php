@extends('principal')

@section('contenido')
    <template v-if="menu == 0">
        contenido
    </template>

    <template v-if="menu == 1">
        <contratistas></contratistas>
    </template>
@endsection