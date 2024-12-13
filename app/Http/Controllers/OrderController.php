<?

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(OrderStoreRequest $request): JsonResponse
    {
        $order = $this->orderService->createOrder($request->validated());
        return response()->json(['success' => true, 'data' => $order], 201);
    }

    public function getUserOrders(OrderRequest $request): JsonResponse
    {
        $userId = $request->validatedUserId();
        $orders = $this->orderService->getUserOrders($userId);
        return response()->json($orders);
    }
}
