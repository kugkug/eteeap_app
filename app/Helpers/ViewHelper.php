<?php

declare(strict_types=1);
namespace App\Helpers;

class ViewHelper {

    public function createCompanyTable(array $data): mixed {

        $fetched_data = $data['list'];
        $current = $fetched_data['current_page'];
        $data = $fetched_data['data'];
        $links = $fetched_data['links'];
        $next_page = $fetched_data['next_page_url'];
        $prev_page = $fetched_data['prev_page_url'];
        $per_page = $fetched_data['per_page'];
        $last_page = $fetched_data['last_page'];
        $total_count = $fetched_data['total'];
        $page_count = ceil($total_count / $per_page);
        
        $table = "<table class='table table-striped table-hover'>";
        $table .="<thead>
                    <tr>
                        <th> Code </th>
                        <th> Name </th>
                        <th> Email </th>
                        <th> Contact No. </th>
                        <th> Address </th>
                        <th> Representative </th>
                        <th> Action </th>
                    </tr>
                </thead>";
        if (count($data) > 0) {
            foreach($data as $company) {
                $actions = "
                    
                        <button type='button' class='btn btn-warning dropdown-toggle dropdown-icon btn-sm' data-toggle='dropdown' aria-expanded='false'>
                            <span class='sr-only'>Toggle Dropdown</span>
                        </button>
                        <div class='dropdown-menu' role='menu'>
                            <a class='dropdown-item text-green' href='/company/edit/".$company['id']."'>
                                <i class='fa fa-edit'></i> Edit
                            </a>
                            <div class='dropdown-divider'></div>
                            <a class='dropdown-item text-primary' href='/company/add-users/".$company['id']."'>
                                <i class='fa fa-user-plus'></i> Add Users
                            </a>
                            <div class='dropdown-divider'></div>
                            <a class='dropdown-item text-danger' href='#' data-delete='".$company['id']."'>
                                <i class='fa fa-ban'></i> Deactivate
                            </a>
                        </div>
                    
                ";

                $table .= "<tr>
                        <td>".$company['code']."</td>
                        <td>".$company['name']."</td>
                        <td>".$company['email']."</td>
                        <td>".$company['phone']."</td>
                        <td>".$company['address']."</td>
                        <td>".$company['representative']."</td>
                        <td>".$actions."</td>
                    </tr>";
            }
        }
        
        $table .="</table>";
    
        $next = $next_page ? (explode("?", $next_page))[1] : '';
        $prev = $prev_page ? (explode("?", $prev_page))[1] : '';

        $pager = "
        
                <div class='col-md-6'>
                    <div class='dataTables_info' role='status' aria-live='polite'>
                        Showing ".$current." to ".$page_count." of ".$total_count." records
                    </div>
                </div>
                
                <div class='col-md-6 dataTables_paginate paging_simple_numbers'>
                    <ul class='pagination'>
                        <li class='paginate_button page-item ".($prev == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page=''>
                                <i class='fas fa-angle-double-left'></i>
                            </a>
                        </li>
                        <li class='paginate_button page-item previous ".($prev == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page='".$prev."'>
                                <i class='fas fa-angle-left'></i>
                            </a>
                        </li>
                        <li class='paginate_button page-item next ".($next == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page='".$next."'>
                                <i class='fas fa-angle-right'></i>
                            </a>
                        </li>
                        <li class='paginate_button page-item ".($next == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page='page=".$last_page."'>
                                <i class='fas fa-angle-double-right'></i>
                            </a>
                        </li>
                    </ul>
                </div>
            ";

        return "
            $('.div-table-data').html(\"".preg_replace('/\s+/', ' ', $table)."\");
            $('.paginator').html(\"".preg_replace('/\s+/', ' ', $pager)."\");
            _execWidget();
        ";
        return [
            'html' => $table,
            'links' => $links,
            'next' => $next_page,
            'prev' => $prev_page,
            'perpage' => $per_page,
            'total' => $total_count
        ];
    }   

    public function createAccountsTable(array $data): mixed {

        $fetched_data = $data['list'];
        $current = $fetched_data['current_page'];
        $data = $fetched_data['data'];
        $links = $fetched_data['links'];
        $next_page = $fetched_data['next_page_url'];
        $prev_page = $fetched_data['prev_page_url'];
        $per_page = $fetched_data['per_page'];
        $last_page = $fetched_data['last_page'];
        $total_count = $fetched_data['total'];
        $page_count = ceil($total_count / $per_page);
        
        $table = "<table class='table table-striped table-hover'>";
        $table .="<thead>
                    <tr>
                        <th> Fullname </th>
                        <th> Company </th>
                        <th> Username </th>
                        <th> Access Level </th>
                        <th> Action </th>
                    </tr>
                </thead>";
        if (count($data) > 0) {
            foreach($data as $account) {
                $actions = "
                    
                        <button type='button' class='btn btn-warning dropdown-toggle dropdown-icon btn-sm' data-toggle='dropdown' aria-expanded='false'>
                            <span class='sr-only'>Toggle Dropdown</span>
                        </button>
                        <div class='dropdown-menu' role='menu'>
                            <a class='dropdown-item text-green' href='/account/edit/".$account['id']."'>
                                <i class='fa fa-edit'></i> Edit
                            </a>
                            <div class='dropdown-divider'></div>
                            <a class='dropdown-item text-primary' href='#' data-reset=".$account['id']."'>
                                <i class='fa fa-edit'></i> Reset Password
                            </a>
                            <div class='dropdown-divider'></div>
                            <a class='dropdown-item text-danger' href='#' data-delete='".$account['id']."'>
                                <i class='fa fa-ban'></i> Deactivate
                            </a>
                        </div>
                    
                ";

                $table .= "<tr>
                        <td>".join(" ", [$account['firstname'], $account['lastname']])."</td>
                        <td>".($account['company']['name'] ?? '')."</td>
                        <td>".$account['username']."</td>
                        <td>".config('custom.user_type')[$account['user_type']]."</td>
                        <td>".$actions."</td>
                    </tr>";
            }
        }
        
        $table .="</table>";
    
        $next = $next_page ? (explode("?", $next_page))[1] : '';
        $prev = $prev_page ? (explode("?", $prev_page))[1] : '';

        $pager = "
        
                <div class='col-md-6'>
                    <div class='dataTables_info' role='status' aria-live='polite'>
                        Showing ".$current." to ".$page_count." of ".$total_count." records
                    </div>
                </div>
                
                <div class='col-md-6 dataTables_paginate paging_simple_numbers'>
                    <ul class='pagination'>
                        <li class='paginate_button page-item ".($prev == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page=''>
                                <i class='fas fa-angle-double-left'></i>
                            </a>
                        </li>
                        <li class='paginate_button page-item previous ".($prev == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page='".$prev."'>
                                <i class='fas fa-angle-left'></i>
                            </a>
                        </li>
                        <li class='paginate_button page-item next ".($next == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page='".$next."'>
                                <i class='fas fa-angle-right'></i>
                            </a>
                        </li>
                        <li class='paginate_button page-item ".($next == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page='page=".$last_page."'>
                                <i class='fas fa-angle-double-right'></i>
                            </a>
                        </li>
                    </ul>
                </div>
            ";

        return "
            $('.div-table-data').html(\"".preg_replace('/\s+/', ' ', $table)."\");
            $('.paginator').html(\"".preg_replace('/\s+/', ' ', $pager)."\");
            _execWidget();
        ";
        return [
            'html' => $table,
            'links' => $links,
            'next' => $next_page,
            'prev' => $prev_page,
            'perpage' => $per_page,
            'total' => $total_count
        ];
    }   


    public function createPlayersTable(array $data): mixed {

        $fetched_data = $data['list'];
        $current = $fetched_data['current_page'];
        $data = $fetched_data['data'];
        $links = $fetched_data['links'];
        $next_page = $fetched_data['next_page_url'];
        $prev_page = $fetched_data['prev_page_url'];
        $per_page = $fetched_data['per_page'];
        $last_page = $fetched_data['last_page'];
        $total_count = $fetched_data['total'];
        $page_count = ceil($total_count / $per_page);
        
        $table = "<table class='table table-striped table-hover'>";
        $table .="<thead>
                    <tr>
                        <th> Fullname </th>
                        <th> Nationality </th>
                        <th> Deposit </th>
                        <th> Status </th>
                        <th> Action </th>
                    </tr>
                </thead>";
        if (count($data) > 0) {
            foreach($data as $player) {
                $actions = "
                    
                        <button type='button' class='btn btn-warning dropdown-toggle dropdown-icon btn-sm' data-toggle='dropdown' aria-expanded='false'>
                            <span class='sr-only'>Toggle Dropdown</span>
                        </button>
                        <div class='dropdown-menu' role='menu'>
                            <a class='dropdown-item text-green' href='/player/edit/".$player['id']."'>
                                <i class='fa fa-edit'></i> Edit
                            </a>
                            <div class='dropdown-divider'></div>
                            <a class='dropdown-item text-warning' href='/player/transactions/".$player['id']."'>
                                <i class='fas fa-coins'></i> Transactions
                            </a>
                            <div class='dropdown-divider'></div>
                            <a class='dropdown-item text-primary' href='#' data-delete='".$player['id']."'>
                                <i class='fas fa-cash-register'></i> Cash Out
                            </a>
                        </div>
                    
                ";

                $table .= "<tr>
                        <td>".join(" ", [$player['firstname'], $player['lastname']])."</td>
                        <td>".$player['nationality']['nationality']."</td>
                        <td>".$player['deposit']."</td>
                        <td>Active</td>
                        <td>".$actions."</td>
                    </tr>";
            }
        }
        
        $table .="</table>";

        $next = $next_page ? (explode("?", $next_page))[1] : '';
        $prev = $prev_page ? (explode("?", $prev_page))[1] : '';

        $pager = "
        
                <div class='col-md-6'>
                    <div class='dataTables_info' role='status' aria-live='polite'>
                        Showing ".$current." to ".$page_count." of ".$total_count." records
                    </div>
                </div>
                
                <div class='col-md-6 dataTables_paginate paging_simple_numbers'>
                    <ul class='pagination'>
                        <li class='paginate_button page-item ".($prev == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page=''>
                                <i class='fas fa-angle-double-left'></i>
                            </a>
                        </li>
                        <li class='paginate_button page-item previous ".($prev == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page='".$prev."'>
                                <i class='fas fa-angle-left'></i>
                            </a>
                        </li>
                        <li class='paginate_button page-item next ".($next == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page='".$next."'>
                                <i class='fas fa-angle-right'></i>
                            </a>
                        </li>
                        <li class='paginate_button page-item ".($next == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page='page=".$last_page."'>
                                <i class='fas fa-angle-double-right'></i>
                            </a>
                        </li>
                    </ul>
                </div>
            ";

        return "
            $('.div-table-data').html(\"".preg_replace('/\s+/', ' ', $table)."\");
            $('.paginator').html(\"".preg_replace('/\s+/', ' ', $pager)."\");
            _execWidget();
        ";
        return [
            'html' => $table,
            'links' => $links,
            'next' => $next_page,
            'prev' => $prev_page,
            'perpage' => $per_page,
            'total' => $total_count
        ];
    }

    public function createAgentsTable(array $data): mixed {

        $fetched_data = $data['list'];
        $current = $fetched_data['current_page'];
        $data = $fetched_data['data'];
        $links = $fetched_data['links'];
        $next_page = $fetched_data['next_page_url'];
        $prev_page = $fetched_data['prev_page_url'];
        $per_page = $fetched_data['per_page'];
        $last_page = $fetched_data['last_page'];
        $total_count = $fetched_data['total'];
        $page_count = ceil($total_count / $per_page);
        
        $table = "<table class='table table-striped table-hover'>";
        $table .="<thead>
                    <tr>
                        <th> Code </th>
                        <th> Fullname </th>
                        <th> Contact </th>
                        <th> Email </th>
                        <th> Status </th>
                        
                    </tr>
                </thead>";
                // <th> Action </th>
        if (count($data) > 0) {
            foreach($data as $player) {
                $actions = "
                    
                        <button type='button' class='btn btn-warning dropdown-toggle dropdown-icon btn-sm' data-toggle='dropdown' aria-expanded='false'>
                            <span class='sr-only'>Toggle Dropdown</span>
                        </button>
                        <div class='dropdown-menu' role='menu'>
                            <a class='dropdown-item text-green' href='/player/edit/".$player['id']."'>
                                <i class='fa fa-edit'></i> Edit
                            </a>
                            <div class='dropdown-divider'></div>
                            <a class='dropdown-item text-warning' href='/player/transactions/".$player['id']."'>
                                <i class='fas fa-coins'></i> Transactions
                            </a>
                            <div class='dropdown-divider'></div>
                            <a class='dropdown-item text-primary' href='#' data-delete='".$player['id']."'>
                                <i class='fas fa-cash-register'></i> Cash Out
                            </a>
                        </div>
                    
                ";

                $table .= "<tr>
                        <td>".$player['agent_code']."</td>
                        <td>".join(" ", [$player['firstname'], $player['lastname']])."</td>
                        <td>".$player['phone']."</td>
                        <td>".$player['email']."</td>
                        <td>".config('custom.statuses')[$player['status']]."</td>
                    </tr>";
                    // <td>".$actions."</td>
            }
        }
        
        $table .="</table>";

        $next = $next_page ? (explode("?", $next_page))[1] : '';
        $prev = $prev_page ? (explode("?", $prev_page))[1] : '';

        $pager = "
        
                <div class='col-md-6'>
                    <div class='dataTables_info' role='status' aria-live='polite'>
                        Showing ".$current." to ".$page_count." of ".$total_count." records
                    </div>
                </div>
                
                <div class='col-md-6 dataTables_paginate paging_simple_numbers'>
                    <ul class='pagination'>
                        <li class='paginate_button page-item ".($prev == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page=''>
                                <i class='fas fa-angle-double-left'></i>
                            </a>
                        </li>
                        <li class='paginate_button page-item previous ".($prev == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page='".$prev."'>
                                <i class='fas fa-angle-left'></i>
                            </a>
                        </li>
                        <li class='paginate_button page-item next ".($next == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page='".$next."'>
                                <i class='fas fa-angle-right'></i>
                            </a>
                        </li>
                        <li class='paginate_button page-item ".($next == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page='page=".$last_page."'>
                                <i class='fas fa-angle-double-right'></i>
                            </a>
                        </li>
                    </ul>
                </div>
            ";

        return "
            $('.div-table-data').html(\"".preg_replace('/\s+/', ' ', $table)."\");
            $('.paginator').html(\"".preg_replace('/\s+/', ' ', $pager)."\");
            _execWidget();
        ";
        return [
            'html' => $table,
            'links' => $links,
            'next' => $next_page,
            'prev' => $prev_page,
            'perpage' => $per_page,
            'total' => $total_count
        ];
    }

    
    public function createTransactionsTable(array $data): mixed {

        $fetched_data = $data['list'];
        $current = $fetched_data['current_page'];
        $data = $fetched_data['data'];
        $links = $fetched_data['links'];
        $next_page = $fetched_data['next_page_url'];
        $prev_page = $fetched_data['prev_page_url'];
        $per_page = $fetched_data['per_page'];
        $last_page = $fetched_data['last_page'];
        $total_count = $fetched_data['total'];
        $page_count = ceil($total_count / $per_page);
        
        $table = "<table class='table table-striped table-hover'>";
        $table .="<thead>
                    <tr>
                        <th> Type </th>
                        <th> Reference No. </th>
                        <th> Total Amount </th>
                    </tr>
                </thead>";
                // <th> Action </th>
        if (count($data) > 0) {
            foreach($data as $player) {
                $actions = "
                    
                        <button type='button' class='btn btn-warning dropdown-toggle dropdown-icon btn-sm' data-toggle='dropdown' aria-expanded='false'>
                            <span class='sr-only'>Toggle Dropdown</span>
                        </button>
                        <div class='dropdown-menu' role='menu'>
                            <a class='dropdown-item text-green' href='/player/edit/".$player['id']."'>
                                <i class='fa fa-edit'></i> Edit
                            </a>
                            <div class='dropdown-divider'></div>
                            <a class='dropdown-item text-warning' href='/player/transactions/".$player['id']."'>
                                <i class='fas fa-coins'></i> Transactions
                            </a>
                            <div class='dropdown-divider'></div>
                            <a class='dropdown-item text-primary' href='#' data-delete='".$player['id']."'>
                                <i class='fas fa-cash-register'></i> Cash Out
                            </a>
                        </div>
                    
                ";

                $table .= "<tr>
                        <td>".$player['availment']['type']."</td>
                        <td>".$player['reference_number']."</td>
                        <td>".$player['total_amount']."</td>
                    </tr>";
                    // <td>".$actions."</td>
            }
        }
        
        $table .="</table>";

        $next = $next_page ? (explode("?", $next_page))[1] : '';
        $prev = $prev_page ? (explode("?", $prev_page))[1] : '';

        $pager = "
        
                <div class='col-md-6'>
                    <div class='dataTables_info' role='status' aria-live='polite'>
                        Showing ".$current." to ".$page_count." of ".$total_count." records
                    </div>
                </div>
                
                <div class='col-md-6 dataTables_paginate paging_simple_numbers'>
                    <ul class='pagination'>
                        <li class='paginate_button page-item ".($prev == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page=''>
                                <i class='fas fa-angle-double-left'></i>
                            </a>
                        </li>
                        <li class='paginate_button page-item previous ".($prev == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page='".$prev."'>
                                <i class='fas fa-angle-left'></i>
                            </a>
                        </li>
                        <li class='paginate_button page-item next ".($next == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page='".$next."'>
                                <i class='fas fa-angle-right'></i>
                            </a>
                        </li>
                        <li class='paginate_button page-item ".($next == "" ? "disabled" : "")."'>
                            <a class='page-link' href='#' data-page='page=".$last_page."'>
                                <i class='fas fa-angle-double-right'></i>
                            </a>
                        </li>
                    </ul>
                </div>
            ";

        return "
            $('.div-table-data').html(\"".preg_replace('/\s+/', ' ', $table)."\");
            $('.paginator').html(\"".preg_replace('/\s+/', ' ', $pager)."\");
            _execWidget();
        ";
        return [
            'html' => $table,
            'links' => $links,
            'next' => $next_page,
            'prev' => $prev_page,
            'perpage' => $per_page,
            'total' => $total_count
        ];
    }

}