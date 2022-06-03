<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-end pb-6">
                        <a href="{{route('articles.create')}}">
                            <button type="button" class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                Crear Articulo
                            </button>
                        </a>

                    </div>
                    <table id="articles_table">
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Título</th>
                                <th>Autores</th>
                                <th>Tópicos</th>
                                <th>Revisores</th>
                                <th>Fecha Distribución</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                            <tr>
                                <td>{{$article->id}}</td>
                                <td>{{$article->title}}</td>
                                <td>
                                    <select name="autors" id="autors">
                                    @foreach ($article->autors as $autor)
                                        <option value="">{{$autor->name}}</option>
                                    @endforeach    
                                    </select>
                                </td>
                                <td>
                                    <select name="subjects" id="subjects">
                                        @foreach ($article->subjects as $subject)
                                            <option value="">{{$subject->name}}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                @isset($article->distribution_date)
                                    No hay fecha de distribución
                                @else
                                    {{$article->distribution_date}}
                                @endisset</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
            
            $('#articles_table').DataTable({
                "bPaginate": false,
            });
        });
    </script>
</x-app-layout>
