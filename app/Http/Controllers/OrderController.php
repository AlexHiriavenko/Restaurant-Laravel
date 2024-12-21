<?

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\OrderStatusUpdateRequest;
use App\Http\Requests\OrderSearchRequest;
use App\Services\OrderService;
use App\Http\Resources\OrderResource;
use App\Enums\OrderStatusEnum;


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

    public function updateStatus(OrderStatusUpdateRequest $request)
    {
        $status = OrderStatusEnum::tryFrom($request->input('status'));
        $orderId = $request->input('order_id');

        $this->orderService->updateStatus($orderId, $status);

        return redirect()->route('orders.search')->with('success', 'Order status updated successfully.');
    }

    public function searchOrders(OrderSearchRequest $request): View
    {
        // Преобразуем статус из строки в enum
        $status = OrderStatusEnum::tryFrom($request->input('status')) ?? null;

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $perPage = $request->input('per_page', 5);

        // Получаем заказы из сервиса
        $orders = $this->orderService->getOrders($status, $startDate, $endDate, $perPage);

        return view('orders.index', compact('orders'));
    }
}
