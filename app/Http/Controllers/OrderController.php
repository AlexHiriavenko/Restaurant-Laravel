<?

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
  private $orderService;

  public function __construct(OrderService $orderService)
  {
    $this->orderService = $orderService;
  }

  public function store(StoreOrderRequest $request): JsonResponse
  {
    $order = $this->orderService->createOrder($request->validated());
    return response()->json(['success' => true, 'data' => $order], 201);
  }
}
