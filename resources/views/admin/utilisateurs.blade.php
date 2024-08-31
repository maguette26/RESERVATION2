@extends('layouts.app')

@section('title', 'Gestion des utilisateurs')

@section('content')

@section('notice')
    @if (session('status'))
        <div class="alert alert-info" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endsection

<div class="container mt-4">
    <h1 class="text-center mb-4 text-primary">Gestion des Utilisateurs</h1>

    <style>
        /* Stylish Font */
        body {
            font-family: 'Times New Roman', serif;
        }

        .status-confirmed {
            color: #28a745; /* Green */
            font-weight: bold;
        }

        .status-cancelled {
            color: #dc3545; /* Red */
            font-weight: bold;
        }

        .status-pending {
            color: #ffc107; /* Yellow */
            font-weight: bold;
        }

        .reservation-status {
            padding: 0.25rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
        }

        /* Table styling */
        .table {
            margin-bottom: 0;
            font-size: 0.875rem;
        }

        .table th {
            background-color: #007bff;
            color: #fff;
        }

        .table thead th {
            font-weight: bold;
        }

        .table td {
            vertical-align: middle;
        }

        /* Form group spacing */
        .form-group {
            margin-bottom: 0;
        }

        /* Button styling */
        .btn-primary {
            background-color: #007bff;
            border: none;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            color: #fff;
        }
    </style>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Email</th>
                    <th>Date d'inscription</th>
                    <th>Dernière connexion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->prenom }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($user->last_login_at)
                                {{ \Carbon\Carbon::parse($user->last_login_at)->format('d/m/Y H:i') }}
                            @else
                                Jamais connecté
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
