<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('membership_status', $request->get('status'));
        }

        // Period filter
        if ($request->filled('period')) {
            $period = $request->get('period');
            switch ($period) {
                case 'today':
                    $query->whereDate('membership_date', today());
                    break;
                case 'week':
                    $query->whereBetween('membership_date', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('membership_date', now()->month)
                        ->whereYear('membership_date', now()->year);
                    break;
                case 'year':
                    $query->whereYear('membership_date', now()->year);
                    break;
            }
        }

        $members = $query->with(['borrowings' => function($q) {
            $q->latest();
        }])->orderBy('name')->paginate(15);

        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(StoreMemberRequest $request)
    {
        Member::create($request->validated());

        return redirect()
            ->route('members.index')
            ->with('success', 'សមាជិកត្រូវបានបន្ថែមដោយជោគជ័យ!');
    }

    public function show(Member $member)
    {
        $member->load(['borrowings.book']);
        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(UpdateMemberRequest $request, Member $member)
    {
        $member->update($request->validated());

        return redirect()
            ->route('members.show', $member)
            ->with('success', 'ព័ត៌មានសមាជិកត្រូវបានកែប្រែដោយជោគជ័យ!');
    }

    public function destroy(Member $member)
    {
        // Check if member has active borrowings
        if ($member->borrowings()->active()->exists()) {
            return redirect()
                ->route('members.show', $member)
                ->with('error', 'មិនអាចលុបសមាជិកដែលមានការខ្ចីសកម្មបានទេ!');
        }

        $member->delete();

        return redirect()
            ->route('members.index')
            ->with('success', 'សមាជិកត្រូវបានលុបដោយជោគជ័យ!');
    }

    public function exportHistory(Member $member)
    {
        $member->load(['borrowings.book']);

        $pdf = Pdf::loadView('members.history-pdf', compact('member'));

        return $pdf->download("member-history-{$member->id}-" . now()->format('Y-m-d') . ".pdf");
    }
}
