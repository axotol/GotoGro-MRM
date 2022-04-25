/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package web;

import entity.MyMemberDTO;
import javax.inject.Named;
import javax.enterprise.context.RequestScoped;
import session.MymemberFacadeRemote;

/**
 *
 * @author Justin
 */
@Named(value = "mymemberManagedBean")
@RequestScoped
public class MymemberManagedBean {

    @javax.ejb.EJB
    private MymemberFacadeRemote mymemberFacade;

    /**
     * Creates a new instance of MymemberManagedBean
     */
    private String memberid;
    private String name;
    private String phoneNumber;
    private String email;
    private String address;
    private String status;

    public MymemberManagedBean() {
    }

    public MymemberFacadeRemote getMymemberFacade() {
        return mymemberFacade;
    }

    public void setMymemberFacade(MymemberFacadeRemote mymemberFacade) {
        this.mymemberFacade = mymemberFacade;
    }

    public String getMemberid() {
        return memberid;
    }

    public void setMemberid(String memberid) {
        this.memberid = memberid;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getPhoneNumber() {
        return phoneNumber;
    }

    public void setPhoneNumber(String phoneNumber) {
        this.phoneNumber = phoneNumber;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    /* 
    * add a user to the database 
    * @return "success" if the add operation is successful 
    *         "failure" otherwise 
     */
    public String addMember() {

        String result = "failure";

        if (isValidMemberid(memberid) && isValidName(name)
                && isValidEmail(phoneNumber) && isValidPhone(email)
                && isValidAddress(address) && isValidStatus(status)) {

            MyMemberDTO myuserDTO = new MyMemberDTO(memberid, name,
                    phoneNumber, email, address, status);

            if (mymemberFacade.createMember(myuserDTO)) {
                result = "success";
            } else {
                result = "failure";
            }
        }
        return result;
    }

    public String getMember() {
        String result = "failure";
        if (isValidMemberid(memberid)) {
            MyMemberDTO myuser = mymemberFacade.getMember(memberid);
            if (myuser != null) {
                setMemberid(myuser.getMemberid());
                setName(myuser.getName());
                setPhoneNumber(myuser.getPhoneNumber());
                setEmail(myuser.getEmail());
                setAddress(myuser.getAddress());
                setStatus(myuser.getStatus());

                result = "success";
            }
        }
        return result;
    }

    public String updateMember() {
        String result = "failure";
        if (isValidMemberid(memberid) && isValidName(name)
                && isValidEmail(phoneNumber) && isValidPhone(email)
                && isValidAddress(address) && isValidStatus(status)) {
            
            MyMemberDTO myuserDTO = new MyMemberDTO(memberid, name,
                    phoneNumber, email, address, status);
            
            if (mymemberFacade.updateMember(myuserDTO)) {
                result = "success";
            }
        }
        return result;
    }

    
    public String deleteMember(){
        String result = "failure";
        if (isValidMemberid(memberid)){
            mymemberFacade.deleteMember(memberid);
            result = "success";
        }
        return result;
    }
    
    
    public boolean isValidMemberid(String memberid) {
        return (memberid != null);
    }

    public boolean isValidName(String name) {
        return (name != null);
    }

    public boolean isValidPhone(String phoneNumber) {
        return (phoneNumber != null);
    }

    public boolean isValidEmail(String email) {
        return (email != null);
    }

    public boolean isValidAddress(String address) {
        return (address != null);
    }

    public boolean isValidStatus(String status) {
        return (status != null);
    }

}
