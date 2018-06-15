import { Component, OnInit } from '@angular/core';
import { routerTransition } from '../../../router.animations';

@Component({
    selector: 'app-blank-page',
    templateUrl: './company.component.html',
    styleUrls: ['./company.component.scss'],
    animations: [routerTransition()]
})
export class CompanyComponent implements OnInit {
    
    DataForGrid : string;
    jsonObj : object;

    AllPages : number[];
    CurrentPage : number;

    constructor() {

        this.DataForGrid = '{"datas":[{"companyId":1,"companyName":"Com1"},{"companyId":2,"companyName":"Com2"}]}';
        this.jsonObj  = JSON.parse(this.DataForGrid);

        this.AllPages = [];
        for (let i = 0 ; i <= 10 ; i++){
            this.AllPages.push(i);
        }
        this.CurrentPage = 2;
        console.log(this.jsonObj);
    }

    ngOnInit() {}
}
