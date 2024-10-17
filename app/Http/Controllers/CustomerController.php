<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\KycStatus;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Customer::all();
        return Customer::withTrashed()->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $validatedData = $request->validated();

        // Générer un code client unique
        do {
            // Générer un numéro aléatoire unique à 6 chiffres
            $randomNumber = rand(100000, 999999);
            $newCode = 'UD' . $randomNumber;
        } while (Customer::where('code_customer', $newCode)->exists()); // Assure que le code est unique

        // Ajouter les valeurs par défaut
        $validatedData['code_customer'] = $newCode; // Attribuer le code client généré
        $validatedData['registered_at'] = now(); // Date d'enregistrement actuelle
        $validatedData['kyc_status'] = KycStatus::PENDING; // Statut KYC par défaut

        // Créer le client
        $customer = Customer::create($validatedData);

        return response()->json($customer, 201);
    }



    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());

        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully']);
    }

     // Méthode pour restaurer un client supprimé
     public function restore($id)
     {
         $customer = Customer::withTrashed()->find($id); // Trouver le client avec soft deletes
         if ($customer && $customer->trashed()) {
             $customer->restore(); // Restaurer le client
             return response()->json(['message' => 'Customer restored successfully'], 200);
         }
         return response()->json(['message' => 'Customer not found or not deleted'], 404);
     }
}


// const handleDelete = async () => {
//     if (customerToDelete === null) {
//         console.log('Aucun client sélectionné pour la suppression.');
//         return;
//     }

//     try {
//         console.log('Longueur avant suppression:', customers.length);

//         const response = await fetch(`http://localhost:8000/api/customers/${customerToDelete}`, {
//             method: 'DELETE',
//             headers: {
//                 Authorization: `Bearer ${sessionStorage.getItem('token')}`,
//             },
//         });

//         if (!response.ok) {
//             throw new Error('Échec de la suppression du client');
//         }

//         console.log(`Client avec l'ID ${customerToDelete} supprimé avec succès.`);

//         // Mise à jour de la liste des clients sans le client supprimé
//         setCustomers((prevCustomers) => {
//             const updatedCustomers = prevCustomers.filter(customer => customer.id !== customerToDelete);
//             console.log('Longueur après suppression:', updatedCustomers.length); // Vérification de la longueur après mise à jour
//             return updatedCustomers;
//         });

//         // Incrémentez updateKey pour forcer le re-render
//         setUpdateKey(prevKey => prevKey + 1);

//         toast.success('Customer deleted successfully!');
//         setCustomerToDelete(null);
//     } catch (error) {
//         console.error('Erreur lors de la tentative de suppression du client:', error);
//         toast.error('Failed to delete customer');
//     }
// };
