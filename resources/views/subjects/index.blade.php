<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Temas') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Temas Disponibles
                    <div class=" relative gap-2 pt-2">
                        @foreach ($subjects as $subject)
                        <div>
                            <label class="items-center space-x-3 mb-3">
                                <input type="checkbox" name="checked-demo"
                                    class="form-tick appearance-none bg-white bg-check h-6 w-6 border border-gray-300 rounded-md checked:bg-blue-500 checked:border-transparent focus:outline-none" />
                                <span class="text-gray-700 dark:text-white font-normal">
                                    {{$subject->name}}
                                </span>
                            </label>
                        </div>

                        @endforeach

                    </div>
                    <div class="flex gap-2 pt-2">
                        <div class=" relative ">
                            <input type="textbox" name="subject_name" id="subject_name"
                                class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                placeholder="Tema" />
                        </div>
                        <div class=" relative ">
                            <button type="button" id="add_subject"
                                class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                Agregar Tema
                            </button>
                        </div>
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
            $('#add_subject').click(function(){
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
                        
                        window.location.reload();

                    },
                    error: function(msg) {
                        console.log(msg);
                    }
                });
            });
    </script>
</x-app-layout>
