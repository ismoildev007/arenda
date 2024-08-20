<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ModalController extends Controller
{
    public function markAsSeen(Request $request)
    {
        $ip = $request->ip();
        $sessionKey = 'admin_modal_shown_' . $ip;

        $shownCount = session($sessionKey, 0);
        session([$sessionKey => $shownCount + 1]);

        return response()->json(['status' => 'success']);
    }

    public function checkModal(Request $request)
    {
        $ip = $request->ip();
        $sessionKey = 'admin_modal_shown_' . $ip;

        $shownCount = session($sessionKey, 0);
        $showModal = $shownCount < 2;

        return response()->json(['show_modal' => $showModal]);
    }
}
