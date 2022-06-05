<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Congresos') }}
        </h2>
    </x-slot>


    <?php $roles_array = array();
    $user = Auth::user(); ?>
    @foreach ($user->roles as $role)
        <?php array_push($roles_array, $role->id) ?>
    @endforeach

    @if(in_array(4, $roles_array))
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2>Congresos</h2>
                    <div class="flex justify-end pb-6">
                        <a href="{{ route('events.create') }}">
                            <button type="button"
                                class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                Crear Evento
                            </button>
                        </a>
                    </div>
                    <div>
                        <table id="event_datatable">
                            <thead>
                                <tr>
                                    <th>
                                        Nombre del Evento
                                    </th>
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Responsables
                                    </th>
                                    <th>

                                    </th>
                                    <th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                <tr>
                                    <td>
                                        {{$event->name}}
                                    </td>
                                    <td>
                                        {{date('d-m-Y', strtotime($event->event_date));}}
                                    </td>
                                    <td>
                                        @isset($event->users)
                                            <select name="users_responsibles" id="users_responsibles">
                                                @foreach ($event->users as $user)
                                                    <option value="">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            No hay responsables
                                        @endisset
                                    </td>
                                    <td>
                                        <a href="{{route('event.user_view', $event)}}">
                                            <button type="button"
                                                class="py-2 px-4  bg-pink-600 hover:bg-pink-700 focus:ring-pink-500 focus:ring-offset-pink-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                                Asignar Responsables
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="">
                                            <button type="button"
                                                class="py-2 px-4  bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 focus:ring-offset-blue-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                                Asignar Sesión
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>Sesiones</h1>

                    <div class="flex justify-end pb-6">
                        <a href="{{ route('sessions.create') }}">
                            <button type="button"
                                class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                Crear Sesión
                            </button>
                        </a>

                    </div>
                    <table id="session_datatable" class="display">
                        <thead>
                            <tr>
                                <th>
                                    Evento
                                </th>
                                <th>
                                    Número de Session
                                </th>
                                <th>
                                    Hora de Inicio
                                </th>
                                <th>
                                    Hora fin
                                </th>
                                <th>

                                </th>
                                <th>
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sessions as $session)
                            <tr>
                                <td>
                                    {{$session->event->name}}
                                </td>
                                <td>
                                    {{$session->id}}
                                </td>
                                <td>
                                    {{$session->begin_hour}}
                                </td>
                                <td>
                                    {{$session->end_hour}}
                                </td>
                                <td>
                                    <a href="{{route('sessions.articles', $session)}}">
                                        <button type="button"
                                            class="py-2 px-4  bg-pink-600 hover:bg-pink-700 focus:ring-pink-500 focus:ring-offset-pink-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                            Asignar Articulos
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif


    <!--Data table script-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#event_datatable').DataTable();
            $('#session_datatable').DataTable();
        });
    </script>
</x-app-layout>
