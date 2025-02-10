@extends('layouts.app')

@section('title', 'Contacts')

@section('content')
<div class="row justify-content-center">
    <div class="col-6 mx-auto">
        <div class="row my-0">
            <div class="col-12 text-end">
                <a href="{{ route('contacts.create') }}">Add Contact</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <input type="text" id="search" class="form-control" placeholder="Search contacts">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <table class="table w-full">
                    <thead class="text-center">
                        <tr class="fw-bold">
                            <th>Name</th>
                            <th>Company</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="contact-list">
                        @foreach ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->company_name }}</td>
                                <td>{{ $contact->phone_number }}</td>
                                <td>{{ $contact->company_email }}</td>
                                <td>
                                    <div class="row justify-content-center">
                                        <div class="col-auto">
                                            <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        </div>
                                        <div class="col-auto">
                                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="post" onsubmit="return confirmDelete(event)">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.getElementById('search').addEventListener('input', function () {
        const query = this.value;

        if (query.length >= 1) {
            axios.get(`/api/contacts/search?query=${query}`)
                .then(response => {
                    const contacts = response.data;
                    const contactList = document.getElementById('contact-list');
                    contactList.innerHTML = ''; // Clear the current list

                    contacts.forEach(contact => {
                        contactList.innerHTML += `
                            <tr>
                                <td>${contact.name}</td>
                                <td>${contact.company_name}</td>
                                <td>${contact.phone_number}</td>
                                <td>${contact.company_email}</td>
                                <td>
                                    <div class="row justify-content-center">
                                        <div class="col-auto">
                                            <a href="/contacts/${contact.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                                        </div>
                                        <div class="col-auto">
                                            <form action="/contacts/${contact.id}" method="post onsubmit="return confirmDelete(event)"">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        }
    });
    function confirmDelete(event) {
    event.preventDefault();

    if (confirm("Are you sure you want to delete this contact?")) {
        event.target.submit();
    } else {
        return false;
    }
}
</script>
@endsection
