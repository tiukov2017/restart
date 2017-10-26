<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 02/05/16
 * Time: 16:30
 */

namespace App\Http\Controllers\Google;


use App\Http\Controllers\Controller;
use App\Http\Requests\Google\AddDomainRequest;
use App\Http\Requests\Google\DeleteDomainRequest;
use App\Http\Requests\Google\UpdateDomainRequest;
use App\Services\DomainService;
use Illuminate\Support\Facades\Validator;

class RestrictedDomainsController extends Controller
{
    /**
     * @param AddDomainRequest $request
     * @param DomainService $domainService
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function addDomain(AddDomainRequest $request,DomainService $domainService){

        $domainService->create($request->requestToEntity());
        return response()->json('ok');
    }

    /**
     * @param UpdateDomainRequest $request
     * @param DomainService $domainService
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function updateDomain(UpdateDomainRequest $request,DomainService $domainService){

        $response= $domainService->update($request->requestToEntity());
            return response()->json($response);
    }

    /**
     * @param DeleteDomainRequest $request
     * @param DomainService $domainService
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function deleteDomain(DeleteDomainRequest $request,DomainService $domainService){

        $response = $domainService->delete($request->getId());
        return response()->json($response);
    }


    /**
     * @param DomainService $domainService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAll(DomainService $domainService){

        return view('admin/add_domain',['domains' => $domainService->getAll()]);
    }
}