@extends('admin.include.layout')
@section('heading', 'Contact Form')
@section('title', 'Contact Form List')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Contact Form Submissions</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>InqueryType</th>
                
            </tr>
        </thead>
        <tbody>
            @forelse($contacts as $contact)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $contact->fname }} </td>
                    <td>{{ $contact->lname }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->subject }}</td>
                    <td>{{ $contact->message}}</td>
                    <td>{{ $contact->inquiry_type }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No contact form submissions found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
