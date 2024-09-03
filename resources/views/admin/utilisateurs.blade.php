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
    <h1 class="text-center mb-4 text-primary">Liste des Utilisateurs</h1>

    <style>
        /* Stylish Font */
        body {
        font-family: 'Champagne', sans-serif; /* Use 'Champagne' font */
    }

    .custom-table {
        width: 130%; /* Adjust this value as needed */
        max-width: 1200px;
        margin: 0;
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

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th style="width: 10%;">ID</th>
                            <th style="width: 20%;">Nom</th>
                            <th style="width: 20%;">Prenom</th>
                            <th style="width: 30%;">Email</th>
                            <th style="width: 10%;">Date d'inscription</th>
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

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
