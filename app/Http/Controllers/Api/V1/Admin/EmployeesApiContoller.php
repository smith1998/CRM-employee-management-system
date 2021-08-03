<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\Admin\EmployeeResource;
use App\Models\Company;
use App\Models\Employee;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeeResource(Employee::with(['company'])->advancedFilter());
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());

        return (new EmployeeResource($employee))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function create()
    {
        abort_if(Gate::denies('employee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'meta' => [
                'company' => Company::get(['id', 'name']),
            ],
        ]);
    }

    public function show(Employee $employee)
    {
        abort_if(Gate::denies('employee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeeResource($employee->load(['company']));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return (new EmployeeResource($employee))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function edit(Employee $employee)
    {
        abort_if(Gate::denies('employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'data' => new EmployeeResource($employee->load(['company'])),
            'meta' => [
                'company' => Company::get(['id', 'name']),
            ],
        ]);
    }

    public function destroy(Employee $employee)
    {
        abort_if(Gate::denies('employee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employee->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}