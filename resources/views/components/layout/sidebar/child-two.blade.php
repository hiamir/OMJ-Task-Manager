@props(['links'=>[]])
@if(count($links) > 0)
<ul class="pt-2 pl-2">
    @foreach($links as $link)
    <li>
        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-oblue-500"
           href="javascript:;">
            {{$link}}
        </a>
    </li>
    @endforeach
</ul>
    @endif
