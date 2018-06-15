import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { CompanyRoutingModule } from './company-routing.module';
import { CompanyComponent } from './company.component';

import { NgbModule, NgbDropdownModule, NgbModalModule } from '@ng-bootstrap/ng-bootstrap'
@NgModule({
    imports: [
        CommonModule, 
        CompanyRoutingModule,
        NgbModule.forRoot(),
        NgbDropdownModule,
        NgbModalModule
    ],
    declarations: [CompanyComponent]
})
export class CompanyModule {}
