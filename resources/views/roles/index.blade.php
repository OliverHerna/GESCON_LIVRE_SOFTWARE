<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>
    <div class="flex justify-center pt-6 ">
        <form action="{{ route('role_user')}}" method="POST">
            @csrf
            <div class="pt-6">
                <select name='user' class="block w-100 text-gray-700 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                    <option value="">
                        Selecciona un Usuario
                    </option>
                    @foreach ($users as $user)
                    <option value="{{$user->id}}">
                        {{$user->name}}
                    </option>
                    @endforeach 
                </select>
                
            </div>
            <div class="pt-6">
                <select name="role" class="block w-100 text-gray-700 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500" >
                    <option value="">
                        Selecciona un Rol
                    </option>
                    @foreach ($roles as $role)
                    <option value="{{$role->id}}">
                        {{$role->name}}
                    </option>
                    @endforeach 
                    
                </select>
                
            </div>
            <div class="pt-6">
                <button type="submit" class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg ">
                    Asignar Rol
                </button>    
            </div>
                
        </form>
    </div>
    <div class="pb-7 flex justify-center pt-6">
        <table class="table p-4 bg-white shadow rounded-lg">
            <thead>
                <tr>
                    <th class="border p-4 dark:border-dark-5 whitespace-nowrap font-normal text-gray-900">
                        Roles Disponibles
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr class="text-gray-700">
                    <td class="border p-4 dark:border-dark-5">
                        {{$role->name}}
                    </td>
                </tr>   
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
