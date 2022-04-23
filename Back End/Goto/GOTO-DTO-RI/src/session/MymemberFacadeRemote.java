/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package session;

import entity.MyMemberDTO;
import javax.ejb.Remote;

/**
 *
 * @author Justin
 */
@Remote
public interface MymemberFacadeRemote {

    boolean createMember(MyMemberDTO mymemberDTO);

    MyMemberDTO getMember(String userId);

    boolean updateMember(MyMemberDTO mymemberDTO);

    boolean deleteMember(String userId);
    
}
