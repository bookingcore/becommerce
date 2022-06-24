<?php

    namespace Modules\Email\Admin;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;
    use Modules\AdminController;
    use Modules\Email\Emails\TestEmail;

    class EmailController extends AdminController
    {

        public function testEmail(Request $request)
        {
            $to = $request->to;
            Mail::to($to)->queue(new TestEmail());
            return response()->json(['error' => false], 200);
        }
    }
