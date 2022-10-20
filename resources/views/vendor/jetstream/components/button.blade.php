<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-olblue-300 border border-transparent
rounded-md font-semibold text-xs text-white dark:text-oblue-100 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-olblue-900 dark:hover:bg-olblue-400 active:bg-gray-900 focus:outline-none
focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
