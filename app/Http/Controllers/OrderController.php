<?

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\OrderResource;

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
        return response()->json(new OrderResource($order), 201);
    }

    public function getUserOrders(OrderRequest $request): JsonResponse|array
    {
        $userId = $request->defineUserId();
        $orders = $this->orderService->getUserOrders($userId);
        return OrderResource::collection($orders)->resolve();
    }
}
