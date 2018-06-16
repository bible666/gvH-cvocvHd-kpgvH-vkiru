import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { CompanyRoutingModule } from './company-routing.module';
import { CompanyComponent } from './company.component';

import { NgbModule, NgbDropdownModule, NgbModalModule } from '@ng-bootstrap/ng-bootstrap'

//Add Model
import { CompanyModelComponent } from './company-modal/company-model.component';

@NgModule({
    imports: [
        CommonModule, 
        CompanyRoutingModule,
        NgbModule.forRoot(),
        NgbDropdownModule,
        NgbModalModule
    ],
    declarations: [
        CompanyComponent,
        CompanyModelComponent
    ],
    entryComponents: [
        CompanyModelComponent
    ]
})
export class CompanyModule {}
