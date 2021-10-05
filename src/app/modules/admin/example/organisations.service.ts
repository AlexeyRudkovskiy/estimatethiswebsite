import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {AuthService} from "../../../core/auth/auth.service";

@Injectable({
  providedIn: 'root'
})
export class OrganisationsService {

  constructor(
      private _httpClient: HttpClient,
      private _auth: AuthService
  ) {
      console.log(this._auth);
  }
}
