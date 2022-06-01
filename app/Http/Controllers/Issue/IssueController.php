<?php

namespace App\Http\Controllers\Issue;

use App\Http\Controllers\Controller;
use App\Model\IssueDetail;
use App\Model\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    public function saveIssue(Request $request){
        $issue = IssueDetail::returnInsertDetail($request);
        if($issue > 0){
            if(Stock::singleIssue($request)){
                return '1';
            }
            $issue_d = IssueDetail::find($issue);
            $issue_d->status = 'D';
            $issue_d->last_updated_by = Auth::id();
            $issue_d->save();
        }

        return '0';
    }

    public function issued(){
        return view('issue.issued');
    }

    public function transferred(){
        $departments = IssueDetail::getActiveTransferredList();
        return view('issue.transferred', compact('departments'));
    }

    public function deleteIssue(Request $request){
        //delete issue detail
        $issue_detail = IssueDetail::find($request->id);
        //return Stock::updateStockWhenIssueDetailDeleted($issue_detail);
        if($issue_detail){
            if(IssueDetail::returnDelete($request)){
                if(Stock::updateStockWhenIssueDetailDeleted($issue_detail) == '1'){
                    return '1';
                }else{
                    $issue_detail = IssueDetail::find($request->id);
                    $issue_detail->status = 'A';
                    $issue_detail->last_updated_by = Auth::id();
                    $issue_detail->save();
                    return '0';
                }
            }
            return '0';
        }
        return '0';
        //update stock
    }
}
