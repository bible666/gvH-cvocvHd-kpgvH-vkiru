import { Component, OnInit } from '@angular/core';
import { routerTransition } from '../../../router.animations';

import { NgbModal } from '@ng-bootstrap/ng-bootstrap'

import { CompanyModelComponent } from './company-modal/company-model.component';

@Component({
    selector: 'app-blank-page',
    templateUrl: './company.component.html',
    styleUrls: ['./company.component.scss'],
    animations: [routerTransition()]
})
export class CompanyComponent implements OnInit {
    
    DataForGrid : company[];
    jsonObj : object;

    AllPages : number[];
    CurrentPage : number;

    constructor(
        public modalService : NgbModal
    ) {

        this.DataForGrid = [];
        let one : company = new company();
        one.id = 1;
        one.company_name = "Company 1";

        this.DataForGrid.push(one);

        let two : company = new company();
        two.id = 2;
        two.company_name = "Company 2";

        this.DataForGrid.push(two);
        //this.DataForGrid = '{"datas":[{"companyId":1,"companyName":"Com1"},{"companyId":2,"companyName":"Com2"}]}';
        //this.jsonObj  = JSON.parse(this.DataForGrid);

        this.AllPages = [];
        for (let i = 0 ; i <= 10 ; i++){
            this.AllPages.push(i);
        }
        this.CurrentPage = 2;
        //console.log(this.jsonObj);
    }

    ngOnInit() {}

    showAdd(){
        const activeModal = this.modalService.open(CompanyModelComponent);
        activeModal.componentInstance.company_id = 20;
        activeModal.result.then(
            (result) =>{
                alert('passl');
            },(reason) =>{
                alert('ng');
            }
        )
    }
}

export class company{
    id : number;
    company_name : string;
    company_shot_name : string;
    address : string;
    contact_name : string;
    contact_phone : string;
    contact_email : string;
    register_date;
    status : number;
}
