<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asignar Artículo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="pb-6">
                        Programación de la sesión #{{ $session->id }} | {{ $session->event->event_date }}
                    </div>
                    <form method="POST" action="{{ route('sessions.articles_store') }}">
                        @csrf
                        <div class="pb-6 flex gap-8">
                            <div class="relative">
                                <div class="pb-2">
                                    <span>Agregar Artículo</span>
                                </div>
                                <div>
                                    <input type="text" name="session" id="session" value="{{ $session->id }}" hidden>
                                    <select name="article" id="article">

                                        <option value="">Selecciona el Artículo</option>
                                        @foreach ($articles as $article)
                                            <option value="{{ $article->id }}">{{ $article->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class=" relative ">
                                <div class="pb-2">
                                    Inicio de Presentación
                                </div>
                                <input type="time" name="presentation_hour_begin" id="presentation_hour_begin"
                                    class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" />
                            </div>
                            <div class=" relative ">
                                <div class="pb-2">
                                    Fin de Presentación
                                </div>
                                <input type="time" name="presentation_hour_begin" id="presentation_hour_begin"
                                    class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" />
                            </div>
                            <div class="relative pt-8">
                                <input type="submit" value="Agregar Artículo" style="cursor:pointer"
                                    class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        Programación
                    </div>

                    <div>
                        <table id="articles_datatable">
                            <thead>
                                <tr>
                                    <td>
                                        Nombre
                                    </td>
                                    <td>
                                        Inicio de Presentación
                                    </td>
                                    <td>
                                        Fin de Presentación
                                    </td>
                                    <td>
                                        Autores
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($session->articles as $article)
                                    <tr>
                                        <td>{{ $article->title }}</td>
                                        <td>{{ $article->presentation_hour_begin }}</td>
                                        <td>{{ $article->presentation_hour_end }}</td>
                                        <td>
                                            <select name="" id="">
                                                @foreach ($article->autors as $autor)
                                                    <option value="">{{ $autor->name }}</option>
                                                @endforeach
                                            </select>
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
    <!--Data table script-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#articles_datatable').DataTable({
                "paging": false,
            });
        });
        $('#attach_event_to_user').click(function() {
            $article = $('#article option:selected').val();
            $session = document.getElementById('session').value;
            $presentation_hour_begin = document.getElementById('presentation_hour_begin').value;
            $presentation_hour_end = document.getElementById('presentation_hour_end').value;

            $.ajax({
                url: "{{ route('event.user') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: {
                    article: $article,
                    session: $session,
                    presentation_hour_begin: $presentation_hour_begin,
                    presentation_hour_end: $presentation_hour_end,
                },
                success: function(msg) {
                    alert(msg);
                    location.reload();
                },
                error: function(msg) {
                    alert(msg);
                }
            });
        });
    </script>
</x-app-layout>
