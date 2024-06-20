<div class="relative overflow-x-auto">
    {{-- modal create or edit --}}
    <x-modal wire:model="editOrCreateDisplayed" max-width='md'>
        <div class="p-4">
            <h2 class="text-center font-3xl font-bold">
                @if ($id !== null)
                    Editar
                @else
                    Crear
                @endif
                categoría
            </h2>
            <form wire:submit='updateOrStore'>
                <div class="mb-5">
                    <label for="input_name" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                    <input id="input_name" maxlength="100"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Nombre de la categoría" wire:model='name' />
                    @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="input_color" class="block mb-2 text-sm font-medium text-gray-900">Color</label>
                    <input id="input_color"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Hex del color" wire:model='color' />
                    @error('color')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Guardar</button>
            </form>
        </div>
    </x-modal>

    {{-- modal eliminar --}}
    <x-modal wire:model="deleteDisplayed" max-width='md'>
        <div class="p-4">
            <h2 class="text-center font-3xl font-bold">
                Confirmación de eliminación
            </h2>
            <form wire:submit='destroy'>
                <p class="text-lg">¿Estás seguro de eliminar la categoría {{ $name }}?</p>
                <button type="submit"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Eliminar</button>
                <button class="bg-gray-700 text-gray-200 boton" wire:click='cancelDestroy'>Cancelar</button>
            </form>
        </div>
    </x-modal>
    <button class="my-4 boton bg-blue-500 text-gray-100" wire:click='editOrCreate'>Agregar categoría</button>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Nombre
                </th>
                <th scope="col" class="px-6 py-3">
                    Color
                </th>
                <th scope="col" class="px-6 py-3">
                    Opciones
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr class="border-b text-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $category->id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $category->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $category->color }}
                    </td>
                    <td class="px-6 py-4 flex justify-around">
                        <i wire:click='editOrCreate({{ $category }})'
                            class="fa-solid fa-pen-to-square bg-yellow-500 text-gray-200 boton"></i>
                        <i wire:click='dialogDestroy({{ $category }})'
                            class="fa-solid fa-trash bg-red-800 text-gray-200 boton"></i>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
