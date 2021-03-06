/*
 * Copyright (c) WSO2 Inc. (http://www.wso2.org) All Rights Reserved.
 *
 * WSO2 Inc. licenses this file to you under the Apache License,
 * Version 2.0 (the "License"); you may not use this file except
 * in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied. See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */

package org.soasecurity.is.oauth.validation;

import org.apache.axis2.client.Options;
import org.apache.axis2.client.ServiceClient;
import org.apache.axis2.context.ConfigurationContext;
import org.apache.axis2.context.ConfigurationContextFactory;
import org.apache.axis2.transport.http.HttpTransportProperties;
import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.wso2.carbon.identity.oauth2.stub.OAuth2TokenValidationServiceStub;
import org.wso2.carbon.identity.oauth2.stub.dto.OAuth2TokenValidationRequestDTO;
import org.wso2.carbon.identity.oauth2.stub.dto.OAuth2TokenValidationRequestDTO_OAuth2AccessToken;
import org.wso2.carbon.identity.oauth2.stub.dto.OAuth2TokenValidationResponseDTO;

import java.io.File;
import java.io.IOException;

/**
 *
 */
public class TokenValidator {

    private static final String authorizationServerUrl = "https://localhost:9444/services/";

    private static final String authorizationServerUserName = "admin";

    private static final String authorizationServerPassword = "admin";

    private static Log log = LogFactory.getLog(TokenValidator.class);
    
    public static void main(String[] args){

        String accessToken = "d5fd2ddf7425f69666bc54b8ab538d";

        try {

            // Authorization server url is HTTPS
            System.setProperty("javax.net.ssl.trustStore",  getTrustStore());
            System.setProperty("javax.net.ssl.trustStorePassword", "wso2carbon");

            // creating axis2 configurations
            ConfigurationContext configCtx = ConfigurationContextFactory.createConfigurationContextFromFileSystem(null, null);

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //////////////////////////////   Token validation with out Stub class  /////////////////////////////////////

            OAuth2TokenValidationServiceClient validationClient = new OAuth2TokenValidationServiceClient(authorizationServerUrl,
                    authorizationServerUserName, authorizationServerPassword, configCtx);

            ValidationResponse response = validationClient.validate(accessToken);

            if(response.isValid()){
                log.info("Token is valid...!!!");
            } else {
                log.info("Token is NOT valid...!!!");
            }

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////
            ////////////////////////////////   Token validation with Stub class  //////////////////////////////////////

            OAuth2TokenValidationServiceStub stub = new OAuth2TokenValidationServiceStub(configCtx,
                                                            authorizationServerUrl + "OAuth2TokenValidationService");
            ServiceClient client = stub._getServiceClient();
            Options option = client.getOptions();
            option.setManageSession(true);
            HttpTransportProperties.Authenticator authenticator = new HttpTransportProperties.Authenticator();
            authenticator.setUsername(authorizationServerUserName);
            authenticator.setPassword(authorizationServerPassword);
            authenticator.setPreemptiveAuthentication(true);
            option.setProperty(org.apache.axis2.transport.http.HTTPConstants.AUTHENTICATE, authenticator);

            OAuth2TokenValidationRequestDTO requestDTO = new OAuth2TokenValidationRequestDTO();

            // OAuth token is created.
            OAuth2TokenValidationRequestDTO_OAuth2AccessToken token  = new OAuth2TokenValidationRequestDTO_OAuth2AccessToken();
            token.setIdentifier(accessToken);
            token.setTokenType("bearer");

            requestDTO.setAccessToken(token);

            //avoid the null pointer in server side
            requestDTO.setRequiredClaimURIs(new String[] {""});

            OAuth2TokenValidationResponseDTO responseDTO = stub.validate(requestDTO);

            if(responseDTO.getValid()){
                log.info("Token is valid...!!!");
            } else {
                log.info("Token is NOT valid...!!!");
            }

        } catch (Exception e){
            e.printStackTrace();
            log.error(e);
        }                     
    }

    public static String getTrustStore() throws Exception {

        try{
            File file = new File((new File(".")).getCanonicalPath() + File.separator +"resources" +
                    File.separator +"client-truststore.jks");
            if(file.exists()){
                return file.getCanonicalPath();
            } else {
                return null;
            }
        } catch (IOException e) {
            throw new Exception("Error while calculating trust store path", e);
        }
    }
}
