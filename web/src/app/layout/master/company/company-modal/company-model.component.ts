import { Component, OnInit } from '@angular/core';
import { routerTransition } from '../../../../router.animations';

import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
    selector: 'app-company-modal',
    templateUrl: './company-model.component.html',
    styleUrls: ['./company-model.component.scss'],
    animations: [routerTransition()]
})
export class CompanyModelComponent implements OnInit {

    public company_id : number;
    
    company_name : string;
    company_shot_name : string;
    address : string;
    contact_name : string;
    contact_phone : string;
    contact_email : string;

    constructor(){}
    
    ngOnInit() {
    }
}

