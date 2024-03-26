<x-app-layout>
    <div class="m-auto w-5/6 mt-8">
        <div class="border-b border-black mb-10">
            <form class="employeeCreateForm" action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                @csrf  
                <input style="display: none" type="text" name="email" id="employeeMail">   
            </form>
            <div class="flex items-end">
                <button class="text-xl" onclick="return createEmployee()">Medewerker toevoegen</button> 
                @if (\Session::has('error_create'))
                    <p class="ml-10 text-red-600 font-bold">{!! \Session::get('error_create') !!}</p>
                @endif
            </div>
        </div>
        <div class="grid gap-4" style="grid-template-columns: repeat(4, minmax(0, 1fr));">
            @foreach($employees as $employee)
            <div class="bg-slate-200 p-4 shadow-lg rounded-md">
                        <input class="bg-gray-300 text-black placeholder-gray-500 border-none rounded-md shadow-sm" style="width: 100%" type="text" name="name" value="{{$employee->email}}" readonly>
                        <div class="flex justify-between">
                <form method="POST" action="{{ route('employee.destroy', $employee->id) }}">
                    @csrf
                    @method('DELETE')
                            <button class="mt-2 font-bold text-gray-600" onclick="return confirm('Wil je echt de medewerker rechten weg halen?')">Verwijderen</button>
                        </div>
                </form>
            </div>
            @endforeach
        </div>
        
        <script>
        const employeeCreateForm = document.querySelector('.employeeCreateForm');

        function createEmployee(){
            let employeeEmail = prompt('Email van de medewerker');
            let emailInput = document.getElementById('employeeMail');
            emailInput.value = employeeEmail;

            console.log(document.getElementById('employeeMail').value);

            if(emailInput != null){
                employeeCreateForm.submit();
            }
        }
        </script>

    </div>
</x-app-layout>
