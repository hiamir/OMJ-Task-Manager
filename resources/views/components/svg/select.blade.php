@props(['type'=>null])
@switch ($type)
    @case('add')
    <x-svg.add {{$attributes->merge() }}></x-svg.add>
    @break

    @case('checked-circle')
    <x-svg.checked-circle {{$attributes->merge() }}></x-svg.checked-circle>
    @break

    @case('close')
    <x-svg.close {{$attributes->merge() }}></x-svg.close>
    @break

    @case('cog')
    <x-svg.cog {{$attributes->merge() }}></x-svg.cog>
    @break

    @case('cross-circle')
    <x-svg.cross-circle {{$attributes->merge() }}></x-svg.cross-circle>
    @break

    @case('edit')
    <x-svg.edit {{$attributes->merge() }}></x-svg.edit>
    @break

    @case('exclamation')
    <x-svg.exclamation {{$attributes->merge() }}></x-svg.exclamation>
    @break

    @case('exclamation-circle')
    <x-svg.exclamation-circle {{$attributes->merge() }}></x-svg.exclamation-circle>
    @break

    @case('gear')
    <x-svg.gear {{$attributes->merge() }}></x-svg.gear>
    @break

    @case('home')
    <x-svg.home {{$attributes->merge() }}></x-svg.home>
    @break

    @case('information')
    <x-svg.information {{$attributes->merge() }}></x-svg.information>
    @break

    @case('three-dots-horizontal')
    <x-svg.three-dots-horizontal {{$attributes->merge() }}></x-svg.three-dots-horizontal>
    @break

    @case('menu')
    <x-svg.menu {{$attributes->merge() }}></x-svg.menu>
    @break

    @case('nav')
    <x-svg.nav {{$attributes->merge() }} ></x-svg.nav>
    @break

    @case('profile')
    <x-svg.profile {{$attributes->merge() }} ></x-svg.profile>
    @break

    @case('security')
    <x-svg.security  {{$attributes->merge() }} ></x-svg.security>
    @break

    @case('signout')
    <x-svg.signout  {{$attributes->merge() }} ></x-svg.signout>
    @break

    @case('trash')
    <x-svg.trash  {{$attributes->merge() }} ></x-svg.trash>
    @break

    @case('users')
    <x-svg.users  {{$attributes->merge() }} ></x-svg.users>
    @break

@endswitch


