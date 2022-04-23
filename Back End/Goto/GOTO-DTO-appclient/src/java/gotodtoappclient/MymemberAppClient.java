/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gotodtoappclient;

import entity.MyMemberDTO;
import session.MymemberFacadeRemote;

/**
 *
 * @author Justin
 */
public class MymemberAppClient {

    @javax.ejb.EJB
    private static MymemberFacadeRemote mymemberFacade;

    public static void main(String[] args) {
        MymemberAppClient client = new MymemberAppClient();
        // assuming inputs from keyboard or any GUI
        
        //test 1 Creating member
        System.out.println("Test 1 - Creating members\n");
        MyMemberDTO mymemberDTO = new MyMemberDTO("0001", "Justin Lopez", "12345", "102589705@swin.edu.au", "1 fake street", "Active");
        boolean result = client.createMember(mymemberDTO);
        client.showCreateResult(result, mymemberDTO);
        // assuming inputs from keyboard or any GUI
        MyMemberDTO mymemberDTO2 = new MyMemberDTO("0002", "John Smith", "54321", "111111111@swin.edu.au", "1 Sesame St", "Active");
        result = client.createMember(mymemberDTO2);
        client.showCreateResult(result, mymemberDTO2);
        
        
        //test 2 Getting Member
        System.out.println("\nTest 2 - Getting Members\n");
        MyMemberDTO mymember = mymemberFacade.getMember(mymemberDTO.getMemberid());
        client.showGetResult(mymemberDTO.getMemberid(),mymember);
        
        //test 3 Update Member
        System.out.println("\nTest 3 - Update Members\n");
        MyMemberDTO mymemberDTOupdate = new MyMemberDTO("0001", "Justin Smith", "12345", "102589705@swin.edu.au", "1 fake street", "Active");
        mymemberFacade.updateMember(mymemberDTOupdate);
        MyMemberDTO mymemberDTOupdate2 = mymemberFacade.getMember(mymemberDTOupdate.getMemberid());
        client.showUpdateResult(mymember, mymemberDTOupdate2);
        
        //test 4 delete Member
        System.out.println("\nTest 4 - Delete Members\n");
        String usertoDelete = mymemberDTOupdate.getMemberid();
        boolean deletedResult = mymemberFacade.deleteMember(usertoDelete);
        client.showDeleteResult(usertoDelete, deletedResult);
        
    }

    public void showCreateResult(boolean result, MyMemberDTO mymemberDTO) {
        if (result) {
            System.out.println("Record with primary key " + mymemberDTO.getMemberid()
                    + " has been created in the database table.");
        } else {
            System.out.println("Record with primary key " + mymemberDTO.getMemberid()
                    + " could not be created in the database table!");
        }
    }

    public void showGetResult(String userid, MyMemberDTO result) {
        if (result == null) {
            System.out.println("Record with primary key " + userid + " has been found in the database table.");
        } else {
            if (result.getMemberid().equals(userid)) {
                System.out.println("Record with primary key " + userid + " has been found in the database table!");
            } else {
                System.out.println("Record with primary key " + userid + " has not been found in the database table!");
            }
        }
    }

    public void showUpdateResult(MyMemberDTO updated, MyMemberDTO reUpdated) {
        if (updated.getName().equals(reUpdated.getName())) {
            System.out.println("Record with primary key " + updated.getMemberid() + " could not be updated in the database table.");
        } else {
            System.out.println("Record with primary key " + updated.getMemberid() + " has been updated in the database table!");
        }
    }

    public void showDeleteResult(String userid, boolean result) {
        if (result == true) {
            System.out.println("Record with primary key " + userid + " has been deleted in the database table.");
        } else {
            System.out.println("Record with primary key " + userid + " has not been deleted in the database table!");
        }
    }


public Boolean createMember(MyMemberDTO mymemberDTO) {
        return mymemberFacade.createMember(mymemberDTO);
    }

}
