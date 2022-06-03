<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Enviar Articulo') }}
        </h2>
    </x-slot>


    <div class="w-2/3 mb-10 mt-10 bg-white rounded-lg shadow  sm:mx-auto sm:overflow-hidden">
        <div class="px-4 py-8 sm:px-10">
            <div class="relative mt-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300">
                    </div>
                </div>
                <div class="relative flex justify-center text-sm leading-5">
                    <span class="px-2 text-gray-500 bg-white">
                        Nuevo registro
                        <input hidden type="text" id="temporal_identifier" value="{{ $identifier }}">
                    </span>
                </div>
            </div>
            <div class="mt-6">
                <!--<form action="POST" id="upload_article">-->
                <div class="w-full space-y-6">

                    <div class="w-full">
                        <div class=" relative ">
                            <input type="text" name="title" id="title"
                                class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                placeholder="Título" />
                            @if ($errors->has('title'))
                                @foreach ($errors->get('title') as $message)
                                    <div class="pl-2 text-red-600 text-xs">{{ $message }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="w-full">
                        <div class=" relative ">
                            <table id="autors_table">
                                <thead>
                                    <tr>
                                        <th>
                                            Nombre
                                        </th>
                                        <th>
                                            e-mail
                                        </th>
                                        <th>
                                            Afiliación
                                        </th>
                                        <th>
                                            Contacto
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="w-full flex gap-2">
                        <div class=" relative ">
                            <input type="textbox" name="autor_name" id="autor_name"
                                class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                placeholder="Nombre" />
                        </div>
                        <div class=" relative ">
                            <input type="textbox" name="autor_email" id="autor_email"
                                class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                placeholder="Email" />
                        </div>
                        <div class=" relative ">
                            <input type="textbox" name="autor_afiliation" id="autor_afiliation"
                                class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                placeholder="Afiliacion" />
                        </div>
                        <div class=" relative ">
                            <button type="button" id="add_autor"
                                class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                Agregar Autor
                            </button>
                        </div>

                    </div>
                    <div class="w-full">
                        <div class=" relative flex gap-2">
                            @foreach ($subjects as $subject)
                                <label class="flex items-center space-x-3 mb-3">
                                    <input type="checkbox" name="checked-demo" onchange="addSubject(event)"
                                        value="{{ $subject->id }}"
                                        class="form-tick appearance-none bg-white bg-check h-6 w-6 border border-gray-300 rounded-md checked:bg-blue-500 checked:border-transparent focus:outline-none" />
                                    <span class="text-gray-700 dark:text-white font-normal">
                                        {{ $subject->name }}
                                    </span>
                                </label>
                            @endforeach

                        </div>
                    </div>
                    <form id="updload_article">
                        <div class="w-full">
                            <div class="flex justify-center">
                                <div class="mb-3 w-96">
                                    <label for="formFile" class="form-label inline-block mb-2 text-gray-700">Adjuntar
                                        Documento</label>
                                    <input
                                        class="form-control
                                    block
                                    w-full
                                    px-3
                                    py-1.5
                                    text-base
                                    font-normal
                                    text-gray-700
                                    bg-white bg-clip-padding
                                    border border-solid border-gray-300
                                    rounded
                                    transition
                                    ease-in-out
                                    m-0
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        type="file" name="file" id="file">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div>
                    <span class="block w-full rounded-md shadow-sm">
                        <button type="submit" id="create_article"
                            class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                            Subir Documento
                        </button>
                    </span>
                </div>
            </div>


        </div>
    </div>

    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        //Arreglo donde guardaremos los valores de los temas seleccionados
        var subjectArray = [];
        //Funcion para evaluar los eventos segun el valor del checkbox
        function addSubject(e) {
            if (e.target.checked) {
                addToArray(e.target);
            } else {
                removeToArray(e.target);
            }
        }

        //Funcion para agregar los temas en el arreglo
        function addToArray(obj) {
            subjectArray.push(obj.value)
            console.log(subjectArray)
        }

        //Funcion para quitar los temas en el arreglo
        function removeToArray(obj) {
            var index = subjectArray.indexOf(obj.value);
            if (index > -1) {
                subjectArray.splice(index, 1);
            }
            console.log(subjectArray)
        }

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let temporal_identifier = document.getElementById('temporal_identifier').value;
            let autors_table = $('#autors_table').DataTable({
                "bPaginate": false,
                processing: true,
                serverSide: true,
                'order': [
                    [0, 'asc']
                ],
                ajax: {
                    url: "{{ url('articles/create') }}",
                    data: {
                        temporal_identifier: temporal_identifier
                    }
                },
                columns: [{
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'mebership',
                        name: 'mebership',
                    },
                    {
                        data: 'is_contact',
                        name: 'is_contact',
                    },
                ]
            });

            $('#create_article').click(function() {
                $title = document.getElementById('title').value;
                console.log($title);
                $subjects = subjectArray;
                $file = document.getElementById('file').value;
                $.ajax({
                    url: "{{ route('articles.store') }}",
                    type: 'post',
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    data: {
                        title: $title,
                        temporal_identifier: temporal_identifier,
                        subjects: $subjects,
                        file: $file,
                    },
                    success: function(msg) {
                        attachFile();
                    },
                    error: function(msg) {
                        console.log(msg);
                    }
                });
            });

            function attachFile(){
                
                console.log('Inicio de proceso de envio de documento');
                var formData = new FormData($('#updload_article')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('article.document') }}",
                    data: formData,
                    cache : false,
                    processData: false,
                    contentType: false,
                    success: function(msg) {
                        alert(msg);

                    },
                    error: function(msg) {
                        console.log(msg);
                    }
                });
            }

            //Funcion para guardar el articulo


            $('#add_autor').click(function() {
                $name = document.getElementById('autor_name').value;
                $email = document.getElementById('autor_email').value;
                $membership = document.getElementById('autor_afiliation').value;

                $.ajax({
                    url: '{{ url('autors') }}',
                    type: 'get',
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    data: {
                        name: $name,
                        email: $email,
                        membership: $membership,
                        temporal_identifier: temporal_identifier,
                    },
                    success: function(msg) {
                        autors_table.ajax.reload(null, false);
                        alert(msg)

                    },
                    error: function(msg) {
                        console.log(msg);
                    }
                });

            });


            $('#add_subject').click(function() {
                var table = $('#autors_table').DataTable();
                $name = document.getElementById('subject_name').value;
                console.log($name);
                $.ajax({
                    url: '{{ url('subjects') }}',
                    type: 'post',
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    data: {
                        name: $name,
                    },
                    success: function(msg) {
                        alert(msg)

                    },
                    error: function(msg) {
                        console.log(msg);
                    }
                });
            });
        });
    </script>
</x-app-layout>
