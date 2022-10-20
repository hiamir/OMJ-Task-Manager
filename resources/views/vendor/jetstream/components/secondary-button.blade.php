<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2
bg-white dark:bg-oblue-400 border border-gray-300 dark:border-olblue-800 rounded-md font-semibold text-xs text-gray-700 dark:text-olblue-700
 uppercase tracking-widest shadow-sm hover:text-gray-500 dark:hover:text-olblue-800 focus:outline-none focus:border-blue-300 dark:focus:border-olblue-800 focus:ring focus:ring-blue-200 dark:focus:ring-olblue-800
 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
