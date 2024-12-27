<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
  /**
   * Получить все уведомления для пользователя.
   *
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function getUserNotifications(Request $request)
  {
    $userId = $request->user()->id;
    $notifications = Notification::where('user_id', $userId)
      ->orderBy('created_at', 'desc')
      ->get();

    return response()->json($notifications);
  }

  public function markAsRead(int $id)
  {
    $notification = Notification::findOrFail($id);
    $notification->update(['was_read' => true]);

    return response()->json([
      'message' => 'Notification marked as read',
      'notification' => $notification,
    ]);
  }

  public function deleteNotification(int $id)
  {
    $notification = Notification::findOrFail($id);
    $notification->delete();

    return response()->json([
      'message' => 'Notification deleted successfully',
    ]);
  }

  public function deleteAllUserNotifications(Request $request)
  {
    $userId = $request->user()->id; // Получаем ID текущего пользователя
    Notification::where('user_id', $userId)->delete();

    return response()->json([
      'message' => 'All notifications for the user have been deleted',
    ]);
  }
}
