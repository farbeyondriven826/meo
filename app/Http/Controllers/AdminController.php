<?php

namespace App\Http\Controllers;

use App\Models\{
    ApplicationForm,
    Category,
    History,
    Requirement
};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    protected $history;

    public function __construct(History $history)
    {
        $this->history = $history;
    }

    public function index()
    {
        $history = $this->history->histories(5);
        $queue = ApplicationForm::with('client')->limit(5)->get();

        $applicationTypes = [
            'businessPermit' => 1,
            'building' => 2,
            'renewal' => 3,
        ];
        $applicants = ApplicationForm::where('expiry_date', '<=', Carbon::now()->subMonths(2))
            ->whereNotNull('expiry_date')
            ->get();
        $totals = [];
        $totalsToday = [];
        $totalsApproved = [];

        foreach ($applicationTypes as $key => $type) {
            $totals[$key] = ApplicationForm::getTotalRecord($type);
            $totalsToday[$key] = ApplicationForm::getTotalRecordToday($type);
            $totalsApproved[$key] = ApplicationForm::getTotalApprove($type);
        }

        return Inertia::render('Admin/Dashboard/Index', [
            'data' => compact([
                'history',
                'queue',
                'totals',
                'totalsToday',
                'totalsApproved',
                'applicants'
            ]),
        ]);
    }

    public function addCategory(Request $request)
    {
        Category::createRecord($request->category);
    }

    public function getBusinessRenewalReqs()
    {
        $requirements = Requirement::getRequirements(null, 3);

        return Inertia::render('Admin/Dashboard/Partials/AdminDocumentViewRenewalPermit', [
            'requirements' => $requirements
        ]);
    }

    public function getBusinessReqs()
    {
        $requirements = Requirement::getRequirements(null, 1);

        return Inertia::render('Admin/Dashboard/Partials/AdminDocumentViewBusinessPermit', [
            'requirements' => $requirements
        ]);
    }

    public function getBuildingReqs()
    {
        $requirements = Requirement::getRequirements(null, 2);

        return Inertia::render('Admin/Dashboard/Partials/AdminDocumentViewBldgPermit', [
            'requirements' => $requirements
        ]);
    }
    public function views($query, $type)
    {
        $data = null;
        $approve = ApplicationForm::with('client')->where('type', $type)->where('status', "Approved")->get();
        $total = ApplicationForm::with('client')->where('type', $type)->get();
        $today = ApplicationForm::with('client')->where('type', $type)->whereDate('created_at', Carbon::today())->get();

        $myType = '';
        if ($query == 'approved') {
            if ($type == 1) {
                $myType = 'Total of Business Permit Approved';
            } else if ($type == 2) {
                $myType = 'Total of Building Permit Approved';
            } else if ($type == 3) {
                $myType = 'Total of Renewal Permit Approved';
            }
            $data = $approve;
        } else if ($query == 'total') {
            if ($type == 1) {
                $myType = 'Total of Business Permit Application';
            } else if ($type == 2) {
                $myType = 'Total of Building Permit Application';
            } else if ($type == 3) {
                $myType = 'Total of Renewal Permit Application';
            }
            $data = $total;
        } else if ($query == 'today') {
            if ($type == 1) {
                $myType = 'Total of Business Permit Today';
            } else if ($type == 2) {
                $myType = 'Total of Building Permit Today';
            } else if ($type == 3) {
                $myType = 'Total of Renewal Permit Today';
            }
            $data = $today;
        }

        // return $data;
        return Inertia::render('Admin/Dashboard/data', [
            'type' => $myType,
            'queue' => $data
        ]);
    }
}
