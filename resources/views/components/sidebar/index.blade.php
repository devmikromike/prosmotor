<div class="overflow-y-auto rounded-lg shadow-lg dark:bg-gray-800">
  <ul>
    <x-sidebar.section>
      <x-sidebar.common/>
   </x-sidebar.section>
      <x-sidebar.section>

      <x-sidebar.logged/>

    </x-sidebar.section>
    <x-sidebar.section>
      <x-menu.dropdown>
        <x-slot name="trigger">
          <button class="ml-3 p-2" type="button" name="button">Admin</button>
        </x-slot>
        <x-menu.dropdown-link >
        Link 1
        </x-menu.dropdown-link>
        <x-menu.dropdown-link >
        Link 2
        </x-menu.dropdown-link>
        <x-menu.dropdown-link >
        Link 3
        </x-menu.dropdown-link>
      </x-menu.dropdown>
    </x-sidebar.section>
  </ul>

</div>
