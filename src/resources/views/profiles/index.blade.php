@extends('layouts.app')

@section('styles') 
	<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
    <header>
	<div class="container col-9">

		<div class="profile">

			<div class="profile-image">

				<img src="https://images.unsplash.com/photo-1513721032312-6a18a42c8763?w=152&h=152&fit=crop&crop=faces" alt="">

			</div>

			<div class="profile-user-settings">

				<h1 class="profile-user-name">{{ $user->username ?? 'username'}}</h1>
				@can('update', $user->profile)
					<a class="btn profile-edit-btn text-dark" href="/profile/{{ $user->id }}/edit">Edit Profile</a>
					<button class="btn profile-settings-btn" aria-label="profile settings">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
  <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
</svg>
                </button>
				@endcan

			</div>

			<div class="profile-stats">
				<ul>
					<li><span class="profile-stat-count">120</span> príspevkov spätnej väzby</li>
					<li><span class="profile-stat-count">188</span> odohraných hier</li>
				</ul>
			</div>
			<div class="profile-bio">
				<p><span class="profile-real-name">{{ $user->profile->title ?? 'popis'}}</span><br> {{ $user->profile->description ?? 'text' }}</p>
				<a href="{{ $user->profile->url ?? 'odkaz' }}">{{ $user->profile->url ?? 'odkaz' }}</a>
			</div>
			
		</div>
	</div>
    </header>
    </div>
</div>
@endsection
