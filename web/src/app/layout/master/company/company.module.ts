import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { CompanyRoutingModule } from './company-routing.module';
import { CompanyComponent } from './company.component';
import { MyGridComponent } from '../../components/my-grid/my-grid.component';
@NgModule({
    imports: [CommonModule, CompanyRoutingModule],
    declarations: [CompanyComponent,MyGridComponent]
})
export class CompanyModule {}
