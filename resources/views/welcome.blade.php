@extends('layout')

@section('content')
<div class="px-4 py-5 my-5 text-center">
    <div class="mb-4">
        <i class="bi bi-journal-check text-primary" style="font-size: 5rem;"></i>
    </div>
    
    <h1 class="display-5 fw-bold text-dark">Tu Agenda Personal Segura</h1>
    
    <div class="col-lg-6 mx-auto">
        <p class="lead mb-4 text-muted">
            Organiza tus pendientes, clasifícalos por categorías y aumenta tu productividad. 
            Un sistema simple, rápido y privado donde solo tú tienes acceso a tus datos.
        </p>
        
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            @auth
                <a href="{{ route('tareas.index') }}" class="btn btn-primary btn-lg px-4 gap-3 shadow-sm">
                    <i class="bi bi-list-check"></i> Ir a Mis Tareas
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 gap-3 shadow-sm">
                    Iniciar Sesión
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-4 shadow-sm">
                    Crear Cuenta Gratis
                </a>
            @endauth
        </div>
    </div>
</div>

<div class="row g-4 py-5 row-cols-1 row-cols-lg-3 border-top mt-5">
    
    <div class="col d-flex align-items-start">
        <div class="icon-square bg-light text-dark flex-shrink-0 me-3 rounded p-3">
            <i class="bi bi-shield-lock-fill fs-3 text-success"></i>
        </div>
        <div>
            <h3 class="fs-4">100% Privado</h3>
            <p>Tus tareas son solo tuyas. Gracias a nuestro sistema de autenticación, nadie más puede ver o editar tu información.</p>
        </div>
    </div>

    <div class="col d-flex align-items-start">
        <div class="icon-square bg-