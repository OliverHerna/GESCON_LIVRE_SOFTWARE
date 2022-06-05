<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Sesión') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="pb-6">
                        <form method="POST" action="{{route('sessions.store')}}" >
                            @csrf
                            <div class="w-full flex gap-6 pb-6">
                                <div class=" relative ">
                                    <div class="pb-2">
                                        Hora de Inicio de Sesión
                                    </div>
                                    <input type="time" name="begin_hour" id="begin_hour"
                                        class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                        />
                                </div>
                                <div class=" relative ">
                                    <div class="pb-2">
                                        Hora de Fin de Sesión                                    
                                    </div>
                                    <input type="time" name="end_hour" id="end_hour"
                                        class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"/>
                                </div>
                            </div>
                            <div class="pb-6">
                                <div class="pb-2">
                                    <span>Selecciona el Evento</span>
                                </div>
                                <div>
                                    <select name="event" id="event">

                                        <option value="">Selecciona el Evento</option>
                                        @foreach ($events as $event)
                                            <option value="{{$event->id}}">{{$event->name}} | {{date('d-m-Y', strtotime($event->event_date));}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <input type="submit" value="Guardar Sesión" style="cursor:pointer"
                            class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!--Data table script-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
</x-app-layout>
