/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package entity;

import java.io.Serializable;

/**
 *
 * @author Justin
 */
public class MyMemberDTO implements Serializable{
    private final String memberid;
    private final String name;
    private final String phoneNumber;
    private final String email;
    private final String address;
    private final String status;

    public MyMemberDTO(String memberid, String name, String phoneNumber, String email, String address, String status) {
        this.memberid = memberid;
        this.name = name;
        this.phoneNumber = phoneNumber;
        this.email = email;
        this.address = address;
        this.status = status;
    }

    public String getMemberid() {
        return memberid;
    }

    public String getName() {
        return name;
    }

    public String getPhoneNumber() {
        return phoneNumber;
    }

    public String getEmail() {
        return email;
    }

    public String getAddress() {
        return address;
    }

    public String getStatus() {
        return status;
    }
    
    
    
}
