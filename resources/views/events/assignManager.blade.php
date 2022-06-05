<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asignar Responsables') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Asignar Sesiones a {{$event->name}}
                    
                    <div class=" relative gap-2 pt-2">
                        <input  type="text" name="event_attach" id="event_attach" value="{{$event->id}}" hidden>
                        <select name="user_attach" id="user_attach">
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">
                                    {{$user->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-2 pt-2">
                        <div class=" relative ">
                            <button type="button" id="attach_event_to_user"
                                class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                Asignar Responsable
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
        $('#attach_event_to_user').click(function(){
            $user = $('#user_attach option:selected').val();
            $event = document.getElementById('event_attach').value;

            $.ajax({
                url: "{{ route('event.user') }}",
                type: 'POST', 
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data:{
                    user: $user,
                    event: $event,
                }, 
                success: function(msg){
                    alert(msg);
                },
                error: function(msg){
                    alert(msg);
                }
            });
        });
    </script>
</x-app-layout>
