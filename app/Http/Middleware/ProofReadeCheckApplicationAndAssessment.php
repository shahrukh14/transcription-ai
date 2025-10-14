<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProofReadeCheckApplicationAndAssessment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $excludedRoutes = [
            'proof-reader.application.form',
            'proof-reader.application.submit',
            'proof-reader.assessment',
            'proof-reader.assessment.test',
            'proof-reader.assessment.test.segment.update',
            'proof-reader.assessment.test.final.submit',
            'proof-reader.logout',
        ];

        // Skip middleware for specific routes
        if (in_array($request->route()->getName(), $excludedRoutes)) {
            return $next($request);
        }

        //Get current logged in Proof reader
        $proofreader = auth()->guard('reader')->user();

        //can not log in without email verification
        if($proofreader->email_verified == 0){
            Auth::guard('reader')->logout();
            alert()->error('Verification Required', 'Your email is not verified yet. Click on the link you get in email');
            return redirect()->route('proof-reader.login');
        }

        //application form must be submitted after login
        if($proofreader->application_form_submit == 0){
            return redirect()->route('proof-reader.application.form');
        }

        if($proofreader->assessment_1_complete == 0){
            return redirect()->route('proof-reader.assessment');
        }

        if($proofreader->assessment_2_complete == 0){
            return redirect()->route('proof-reader.assessment');
        }

        return $next($request);
    }
}
